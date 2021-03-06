@extends('layouts._frontend')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Subscribe to {{ $plan->name }}

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {!! Session::get('error') !!}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    Name or Company Name:
                                    <br>
                                    <input type="text" name="company_name" required class="form-control">
                                </div>
                                <div class="col-md-4">
                                    Address line 1:
                                    <br>
                                    <input type="text" name="address_line_1" required class="form-control">
                                </div>
                                <div class="col-md-4">
                                    Address line 2 (optional):
                                    <br>
                                    <input type="text" name="address_line_2" class="form-control">
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-4">
                                    Country:
                                    <br>
                                    <select name="country_id" id="" class="form-control">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    City:
                                    <br>
                                    <input type="text" name="city" required class="form-control">
                                </div>
                                <div class="col-md-4">
                                    Postcode:
                                    <br>
                                    <input type="text" name="postcode" class="form-control">
                                </div>

                            </div>

                            <br>

                            <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
                            <input type="hidden" name="payment-method" id="payment-method" value="" />

                            <input id="card-holder-name" class="form-control" type="text" placeholder="Card holder name">

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element"></div>

                            <br />

                            <button id="card-button" class="btn btn-primary">
                                Pay ${{ $plan->price }}
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $( document ).ready(function() {
            let stripe = Stripe("{{ config('stripe.key') }}")
            let elements = stripe.elements()
            let style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }

            let card = elements.create('card', {style: style})
            card.mount('#card-element')

            let paymentMethod = null
            $('#checkout-form').on('submit', function (e) {
                if (paymentMethod) {
                    return true
                }
                stripe.confirmCardSetup(
                    "{{ $intent->client_secret }}",
                    {
                        payment_method: {
                            card: card,
                            billing_details: {name: $('#card-holder-name').val()}
                        }
                    }
                ).then(function (result) {
                    if (result.error) {
                        console.log(result)
                        alert('error')
                    } else {
                        paymentMethod = result.setupIntent.payment_method
                        $('#payment-method').val(paymentMethod)
                        $('#checkout-form').submit()
                    }
                })
                return false
            })
        });
    </script>
@endpush

@section('styles')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
