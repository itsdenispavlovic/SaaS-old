<?php

namespace App\Http\Controllers;

use App\Helpers\NodeHelper;
use App\Models\Country;
use App\Models\Plan;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;

class CheckoutController extends Controller
{
    /**
     * @param $plan_id
     *
     * @return Application|Factory|View|RedirectResponse
     *
     */
    public function checkout($plan_id)
    {
        $data = NodeHelper::getData();
        $data['plan'] = Plan::findOrFail($plan_id);
        $data['countries'] = Country::all();

        $data['currentPlan'] = Auth::user()->subscription('default')->stripe_plan ?? NULL;

        return view('billing.checkout', $data);
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

            Log::info('New subscriber, with "' . $plan->name . '"');

            return redirect()->route('billing')->with('message', 'Subscribed successfully!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
