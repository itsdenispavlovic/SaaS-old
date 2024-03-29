<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentMethods extends Component
{
    public function render()
    {
        $paymentMethods = [];
        $currentPlan = null;
        $defaultPaymentMethod = null;

        if(Auth::check())
        {
            $currentPlan = Auth::user()->subscription('default') ?? NULL;

            if(!is_null($currentPlan))
            {
                $paymentMethods = Auth::user()->paymentMethods();
                $defaultPaymentMethod = Auth::user()->defaultPaymentMethod();
            }
        }

        return view('livewire.payment-methods', compact('currentPlan', 'paymentMethods', 'defaultPaymentMethod'));
    }
}
