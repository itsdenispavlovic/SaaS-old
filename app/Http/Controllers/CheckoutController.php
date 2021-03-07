<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;
use Stripe\Coupon;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * @param $plan_id
     *
     * @return Application|Factory|View|RedirectResponse
     *
     * @throws SubscriptionUpdateFailure
     */
    public function checkout($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $countries = Country::all();

        $currentPlan = Auth::user()->subscription('default')->stripe_plan ?? NULL;

        if (!is_null($currentPlan) && $currentPlan != $plan->stripe_plan_id) {
            // Change the subscription
            Auth::user()->subscription('default')->swap($plan->stripe_plan_id);

            return redirect()->route('billing');
        }

        $subtotal = $plan->price;
        $taxPercent = Auth::user()->taxPercentage();
        $taxAmount = round($subtotal * $taxPercent / 100);
        $total = $subtotal + $taxAmount;

        $intent = Auth::user()->createSetupIntent();

        return view('billing.checkout', compact('plan', 'intent', 'countries', 'subtotal', 'taxPercent', 'taxAmount', 'total'));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function processCheckout(Request $request): RedirectResponse
    {
        $plan = Plan::findOrFail($request->get('billing_plan_id'));

        try {
            Auth::user()->newSubscription(
                'default', $plan->stripe_plan_id
            )
                ->trialDays(10)
                ->withCoupon($request->get('coupon'))
                ->create($request->get('payment-method'));
            Auth::user()->update([
                'trial_ends_at' => NULL,
                'company_name' => $request->get('company_name'),
                'address_line_1' => $request->get('address_line_1'),
                'address_line_2' => $request->get('address_line_2'),
                'country_id' => $request->get('country_id'),
                'city' => $request->get('city'),
                'postcode' => $request->get('postcode')
            ]);

            return redirect()->route('billing')->with('message', 'Subscribed successfully!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|Coupon
     */
    public function checkCoupon(Request $request)
    {
        try {
            Stripe::setApiKey(config('stripe.secret'));
            $coupon = Coupon::retrieve($request->get('coupon_code'));
        } catch (Exception $e)
        {
            return response()->json(['error_text' => 'Coupon not found']);
        }

        return $coupon;
    }
}
