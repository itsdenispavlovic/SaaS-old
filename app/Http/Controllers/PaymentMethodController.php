<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('payment-methods.create', compact('intent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Auth::user()->addPaymentMethod($request->get('payment-method'));
            if($request->get('default') == 1)
            {
                Auth::user()->updateDefaultPaymentMethod($request->get('payment-method'));
            }
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('billing')->with('message', 'Payment method added successfully.');
    }

    /**
     * @param Request $request
     * @param $paymentMethod
     */
    public function markDefault(Request $request, $paymentMethod)
    {
        try {
            Auth::user()->updateDefaultPaymentMethod($paymentMethod);
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('billing')->with('message', 'Payment method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
