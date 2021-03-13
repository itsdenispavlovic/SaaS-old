<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Coupon;
use Stripe\Stripe;

class Checkout extends Component
{
    public $plan = null;
    public $countries = null;

    public $subtotal;
    public $taxPercent;
    public $taxAmount;
    public $total;

    public $discount;
    public $activeCoupon = false;
    public $couponUsed = 0;
    public $respDiscount = false;
    public $messageDiscount = '';

    public function mount($plan, $countries)
    {
        $this->plan = $plan;
        $this->countries = $countries;

        $this->subtotal = $this->plan->price;
        $this->taxPercent = Auth::user()->taxPercentage();
        $this->taxAmount = round($this->subtotal * $this->taxPercent / 100);
        $this->total = $this->subtotal + $this->taxAmount;
    }

    public function checkCoupon()
    {
        try {
            Stripe::setApiKey(config('stripe.secret'));
            $coupon = Coupon::retrieve($this->discount);
            $this->activeCoupon = true;
        } catch (Exception $e)
        {
            $this->respDiscount = true;
            $this->messageDiscount = 'Coupon not found.';
            return response()->json(['error_text' => 'Coupon not found']);
        }

        if($this->activeCoupon && $this->couponUsed < 1)
        {
            $this->respDiscount = true;
            $this->messageDiscount = $coupon->name;

            $payAmount = number_format(($this->subtotal * (1 - floatval($coupon->percent_off) / 100)),2);
            $this->subtotal = $payAmount;
            $this->taxAmount = number_format(($payAmount * $this->taxPercent / 100),2);

            $totalAmount = number_format((floatval($payAmount) + floatval($this->taxAmount)), 2);
            $this->total = $totalAmount;

            $this->couponUsed++;
        }
    }

    public function render()
    {
        $intent = Auth::user()->createSetupIntent();
        return view('livewire.checkout', compact('intent'));
    }
}
