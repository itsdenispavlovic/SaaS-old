<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $payments = Payment::where('user_id', Auth::id())->latest()->paginate(5);
        return view('livewire.payment-history', compact('payments'));
    }
}
