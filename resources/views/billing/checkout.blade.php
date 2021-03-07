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

                            <input type="hidden" id="plan-paying-amount" value="{{ $subtotal }}" />
                            <input type="hidden" id="tax-percent" value="{{ $taxPercent }}">

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

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    Discount code:
                                    <br>
                                    <input type="text" name="coupon" id="coupon" class="form-control">
                                    <div id="coupon-text" style="font-size: 13px"></div>
                                </div>
                                <div class="col-md-8">
                                    <br>
                                    <input type="button" name="coupon-check" id="coupon-check" value="Apply code" class="btn btn-sm btn-primary">
                                </div>
                            </div>

                            <br>

                            <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
                            <input type="hidden" name="payment-method" id="payment-method" value="" />

                            <input id="card-holder-name" class="form-control" type="text" placeholder="Card holder name">

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element"></div>

                            <br />

                            Subtotal:
                            <span class="font-weight-bold" id="amount_subtotal">${{ $subtotal }}</span>
                            <br>
                            Tax ({{ $taxPercent }}%):
                            <span class="font-weight-bold" id="amount_taxes">${{ $taxAmount }}</span>
                            <br>
                            Total:
                            <span class="font-weight-bold" id="amount_total">${{ $total }}</span>

                            <hr>

                            <button id="card-button" class="btn btn-primary">
                                Pay ${{ $total }}
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
            });

            $('#coupon-check').on('click', function (e) {
                $('#coupon-text').text('');
                $.get({
                    url: "{{ route('coupon') }}?coupon_code=" + $('#coupon').val(),
                    contentType: 'application/json',
                    dataType: 'json'
                }).done(function(result) {
                    if(result.error_text)
                    {
                        $('#coupon-text').text(result.error_text)

                    }
                    else
                    {
                        $('#coupon-text').text(result.name);
                        let plan_paying_amount = parseFloat($('#plan-paying-amount').val());
                        let tax_percent = $('#tax-percent').val();
                        let pay_amount = (plan_paying_amount * (1 - parseFloat(result.percent_off) / 100)).toFixed(2);
                        $('#amount_subtotal').text('$' + pay_amount);
                        let tax_amount = (pay_amount * tax_percent / 100).toFixed(2);
                        $('#amount_taxes').text('$' + tax_amount);
                        pay_amount = (parseFloat(pay_amount) + parseFloat(tax_amount)).toFixed(2);
                        $('#amount_total').text('$' + pay_amount);
                        $('#card-button').text('Pay $' + pay_amount);
                        $('#amount_total').text('$' + pay_amount.toFixed(2));
                        $('#card-button').text("Pay $" + pay_amount.toFixed(2));
                    }
                });
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
