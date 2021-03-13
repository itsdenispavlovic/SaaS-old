<?php

namespace App\Http\Controllers;

use App\Helpers\NodeHelper;
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
        $data = NodeHelper::getData();

        $data['payments'] = Payment::where('user_id', Auth::id())->latest()->get();

        return view('billing.index', $data);
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
