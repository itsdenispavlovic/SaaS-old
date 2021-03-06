<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $currentPlan = Auth::user()->subscription('default') ?? NULL;
        if(!is_null($currentPlan))
        {
            $paymentMethods = Auth::user()->paymentMethods();
            $defaultPaymentMethod = Auth::user()->defaultPaymentMethod();
        }

        $payments = Payment::where('user_id', Auth::id())->latest()->get();

        return view('billing.index', compact('plans', 'currentPlan', 'paymentMethods', 'defaultPaymentMethod', 'payments'));
    }

    public function cancelPlan()
    {
        Auth::user()->subscription('default')->cancel();

        return redirect()->route('billing');
    }

    public function resumePlan()
    {
        Auth::user()->subscription('default')->resume();

        return redirect()->route('billing');
    }

    public function downloadInvoice($paymentId)
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
