<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BillingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $monthlyPlan = Plan::where('billing_period', Plan::MONTHLY_PERIOD)->get();
        $yearlyPlan = Plan::where('billing_period', Plan::YEARLY_PERIOD)->get();

        $paymentMethods = [];
        $defaultPaymentMethod = null;
        $currentPlan = null;

        if(Auth::check())
        {
            $currentPlan = Auth::user()->subscription('default') ?? NULL;

            if(!is_null($currentPlan))
            {
                $paymentMethods = Auth::user()->paymentMethods();
                $defaultPaymentMethod = Auth::user()->defaultPaymentMethod();
            }
        }

        $payments = Payment::where('user_id', Auth::id())->latest()->get();

        return view('billing.index', compact('monthlyPlan', 'yearlyPlan', 'currentPlan', 'paymentMethods', 'defaultPaymentMethod', 'payments'));
    }

    /**
     * @return RedirectResponse
     */
    public function cancelPlan(): RedirectResponse
    {
        Auth::user()->subscription('default')->cancel();

        return redirect()->route('billing');
    }

    /**
     * @return RedirectResponse
     */
    public function resumePlan(): RedirectResponse
    {
        Auth::user()->subscription('default')->resume();

        return redirect()->route('billing');
    }

    /**
     * @param $paymentId
     *
     * @return BinaryFileResponse
     */
    public function downloadInvoice($paymentId): BinaryFileResponse
    {
        $payment = Payment::where('user_id', Auth::id())->where('id', $paymentId)->firstOrFail();

        $filename = storage_path('app/invoices/' . $payment->id . '.pdf');
        if(!file_exists($filename))
        {
            abort(404);
        }

        return response()->download($filename);
    }
}
