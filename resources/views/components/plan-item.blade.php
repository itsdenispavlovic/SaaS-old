<div class="col-md-4 text-center">
    <h3>{{ $plan->name }}</h3>
    <b>${{ $plan->price }} / {{ chop($billingPeriod, "ly") }}</b>
    <hr>
    @if(!is_null($currentPlan) && $plan->stripe_plan_id == $currentPlan->stripe_plan)
        Your current plan.
        <br />
        @if(!$currentPlan->onGracePeriod())
            <a href="{{ route('cancel.plan') }}" class="btn btn-danger" onclick="return confirm('Are you sure?');">Cancel plan</a>
        @else
            Your subscription will end on {{ $currentPlan->ends_at->toDateString() }}
            <br>
            <a href="{{ route('resume.plan') }}" class="btn btn-primary">Resume subscription</a>
        @endif
    @else
        <a href="{{ route('checkout', $plan->id) }}" class="btn btn-primary">Subscribe to {{ $plan->name }}</a>
    @endif
</div>
