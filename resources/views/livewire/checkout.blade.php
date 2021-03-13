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
            <input type="text" name="coupon" wire:model="discount" class="form-control">
            @if($respDiscount)
                <div style="font-size: 13px">{{ $messageDiscount }}</div>
            @endif
        </div>
        <div class="col-md-8">
            <br>
            <input type="button" wire:click="checkCoupon" value="Apply code" class="btn btn-sm btn-primary">
        </div>
    </div>

    <br>

    <div wire:ignore>
        <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
        <input type="hidden" name="payment-method" id="payment-method" value="" />

        <input id="card-holder-name" class="form-control" type="text" placeholder="Card holder name">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element"></div>
    </div>

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

            let card = elements.create('card', {
                hidePostalCode: true,
                style: style
            })
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
                        // console.log(result)
                        // alert('error')
                    } else {
                        paymentMethod = result.setupIntent.payment_method
                        $('#payment-method').val(paymentMethod)
                        $('#checkout-form').submit()
                    }
                })
                return false
            });
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
