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
                        <button type="button" wire:click="cancelPlan({{ $plan->id }})" class="btn btn-primary btn-round">Cancel plan</button>
                    @else
                        Your subscription will end on {{ $currentPlan->ends_at->toDateString() }}
                        <br>
                        <button type="button" wire:click="resumePlan" class="btn btn-warning btn-round">Resume subscription</button>
                    @endif
                @else
                    <button type="button" wire:click="selectPlan({{ $plan->id }})" class="btn btn-dark btn-round"> Get it For free </button>
                @endif
            </div>
        </div>
    </div>
</div>
