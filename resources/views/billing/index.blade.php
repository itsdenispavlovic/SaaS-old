@extends('layouts._frontend')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Billing
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {!! Session::get('message') !!}
                    </div>
                @endif

                @if(is_null($currentPlan))
                    You are now on Free Plan. Please choose plan to upgrade:
                    <br/>
                    <br />
                @endif
                <div class="row">
                    @foreach($plans as $plan)
                        <div class="col-md-4 text-center">
                            <h3>{{ $plan->name }}</h3>
                            <b>${{ number_format($plan->price / 100, 2) }} / month</b>
                            <hr>
                            @if($plan->stripe_plan_id == $currentPlan)
                                Your current plan.
                            @else
                                <a href="{{ route('checkout', $plan->id) }}" class="btn btn-primary">Subscribe to {{ $plan->name }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
