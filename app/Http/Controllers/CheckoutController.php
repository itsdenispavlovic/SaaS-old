<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $countries = Country::all();

        $currentPlan = Auth::user()->subscription('default')->stripe_plan ?? NULL;

        if(!is_null($currentPlan) && $currentPlan != $plan->stripe_plan_id)
        {
            // Change the subscription
            Auth::user()->subscription('default')->swap($plan->stripe_plan_id);

            return redirect()->route('billing');
        }

        $intent = auth()->user()->createSetupIntent();

        return view('billing.checkout', compact('plan', 'intent', 'countries'));
    }

    public function processCheckout(Request $request)
    {
        $plan = Plan::findOrFail($request->get('billing_plan_id'));

        try {
            auth()->user()->newSubscription(
                'default', $plan->stripe_plan_id
            )
                ->trialDays(10)
                ->create($request->get('payment-method'));
            auth()->user()->update([
                'trial_ends_at' => NULL,
                'company_name' => $request->get('company_name'),
                'address_line_1' => $request->get('address_line_1'),
                'address_line_2' => $request->get('address_line_2'),
                'country_id' => $request->get('country_id'),
                'city' => $request->get('city'),
                'postcode' => $request->get('postcode')
            ]);
            return redirect()->route('billing')->with('message', 'Subscribed successfully!');
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
