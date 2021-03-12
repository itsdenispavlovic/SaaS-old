<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentHistory extends Component
{
    public function render()
    {
        $payments = Payment::where('user_id', Auth::id())->latest()->get();
        return view('livewire.payment-history', compact('payments'));
    }
}
