<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);

        $currentPlan = Auth::user()->subscription('default')->stripe_plan ?? NULL;

        if(!is_null($currentPlan) && $currentPlan != $plan->stripe_plan_id)
        {
            // Change the subscription
            Auth::user()->subscription('default')->swap($plan->stripe_plan_id);

            return redirect()->route('billing');
        }

        $intent = auth()->user()->createSetupIntent();

        return view('billing.checkout', compact('plan', 'intent'));
    }

    public function processCheckout(Request $request)
    {
        $plan = Plan::findOrFail($request->get('billing_plan_id'));

        try {
            auth()->user()->newSubscription(
                $plan->name, $plan->stripe_plan_id
            )->create($request->get('payment-method'));

            return redirect()->route('billing')->with('message', 'Subscribed successfully!');
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}