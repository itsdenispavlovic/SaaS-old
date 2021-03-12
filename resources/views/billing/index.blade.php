@extends('layouts._frontend')

@section('content')
    <section class="section is-sm section-plans pt-1">
        <img class="section-particle top-0" src="../assets/images/others/particle.svg" alt="">
        <div class="container mt-0">
            <div class="ml-4">
                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {!! Session::get('message') !!}
                    </div>
                @endif

                @if(is_null($currentPlan))
                    You are now on Free Trial. Please choose plan to upgrade:
                @elseif($currentPlan->trial_ends_at)
                    <div class="alert alert-info">
                        Your trial will end on {{ $currentPlan->trial_ends_at->toDateString() }} and your card will be charged.
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <input type="radio" name="billing_period" value="monthly" checked> Monthly
                        <input type="radio" name="billing_period" value="yearly"> Yearly
                    </div>
                </div>
            </div>

            <hr>
            <div class="row flex vcenter mt-4" id="plans_monthly">
                @foreach($monthlyPlan as $plan)
                    <x-plan-item :plan="$plan" :currentPlan="$currentPlan" :billingPeriod="$plan->billing_period"></x-plan-item>
                @endforeach
            </div>
            <div class="row d-none" id="plans_yearly">
                @foreach($yearlyPlan as $plan)
                    <x-plan-item :plan="$plan" :currentPlan="$currentPlan" :billingPeriod="$plan->billing_period"></x-plan-item>
                @endforeach
            </div>
        </div>

        @livewire('payment-methods')

        @if(Auth::check())
            @livewire('payment-history')
        @endif
        <br>
    </section>
@stop

@push('scripts')
    <script>
        $(document).ready(() => {
            $('input[name=billing_period]').change(function() {
                $('#plans_yearly').addClass('d-none');
                $('#plans_monthly').addClass('d-none');
                let billing_period = $(this).filter(':checked').val();
                $('#plans_' + billing_period).removeClass('d-none');
            });
        });
    </script>
@endpush
