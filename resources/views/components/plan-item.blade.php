<div class="col-md-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
    <div class="plan-item has-style1 in-left">
        <div class="plan-head">
            <h4 class="plan-title"> {{ $plan->name }} </h4>
            <div class="flex center">
                <div class="plan-price">{{ $plan->price }} </div> <span class="price-var ">$</span>
{{--                <small class="mt-auto">{{ chop($billingPeriod, "ly") }}</small>--}}
            </div>
            <div class="flex center mt-4">
                @if(!is_null($currentPlan) && $plan->stripe_plan_id == $currentPlan->stripe_plan)
                    Your current plan.
                    <br />
                    @if(!$currentPlan->onGracePeriod())
                        <a href="{{ route('cancel.plan') }}" class="btn btn-primary btn-round" onclick="return confirm('Are you sure?');">Cancel plan</a>
                    @else
                        Your subscription will end on {{ $currentPlan->ends_at->toDateString() }}
                        <br>
                        <a href="{{ route('resume.plan') }}" class="btn btn-warning btn-round">Resume subscription</a>
                    @endif
                @else
                    <a href="{{ route('checkout', $plan->id) }}" class="btn btn-dark btn-round"> Get it For free </a>
                @endif
            </div>
{{--            <b>${{ $plan->price }} / {{ chop($billingPeriod, "ly") }}</b>--}}
        </div>
    </div>
</div>
