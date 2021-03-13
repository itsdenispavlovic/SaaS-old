<?php

namespace App\Http\Controllers;

use App\Helpers\NodeHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = NodeHelper::getData();
        $data['intent'] = auth()->user()->createSetupIntent();
        return view('payment-methods.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Auth::user()->addPaymentMethod($request->get('payment-method'));

            if ($request->get('default') == 1) {
                Auth::user()->updateDefaultPaymentMethod($request->get('payment-method'));
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('billing')->with('message', 'Payment method added successfully.');
    }

    /**
     * @param Request $request
     * @param $paymentMethod
     *
     * @return RedirectResponse
     */
    public function markDefault(Request $request, $paymentMethod): RedirectResponse
    {
        try {
            Auth::user()->updateDefaultPaymentMethod($paymentMethod);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('billing')->with('message', 'Payment method updated successfully.');
    }
}
