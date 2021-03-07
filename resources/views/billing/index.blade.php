@extends('layouts._frontend')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                My Plan
            </div>
            <div class="card-body">
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
                <hr>
                <div class="row" id="plans_monthly">
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
        </div>

        @if(!is_null($currentPlan))
            <br>
            <div class="card">
                <div class="card-header">
                    Payment methods
                </div>
                <div class="card-body">
                     <table class="table">
                         <thead>
                             <tr>
                                 <th>Brand</th>
                                 <th>Expires at</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($paymentMethods as $paymentMethod)
                                 <tr>
                                     <td>{{ $paymentMethod->card->brand }}</td>
                                     <td>{{ $paymentMethod->card->exp_month }} / {{ $paymentMethod->card->exp_year }}</td>
                                     <td>
                                         @if($defaultPaymentMethod->id == $paymentMethod->id)
                                             default

                                         @else
                                             <a href="{{ route('payment-methods.markDefault', $paymentMethod->id) }}">Mark as Default</a>
                                         @endif
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                    <br>
                    <a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Add Payment Method</a>
                </div>
            </div>
        @endif

        <br>
        <div class="card">
            <div class="card-header">
                Payment history
            </div>
            <div class="card-body">
                @if(count($payments) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->total }}</td>
                                <td>
                                    <a href="{{ route('invoices.download', $payment->id) }}" class="btn btn-sm btn-primary">Download invoice</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="alert alert-info">
                        There are not payment made.
                    </div>
                @endif
            </div>
        </div>

        <br>
    </div>
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
