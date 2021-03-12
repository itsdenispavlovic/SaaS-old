<div>
    @if(!is_null($currentPlan) && Auth::check())
        <br>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Payment methods
                </div>
                <div class="card-body">
                    @if(count($paymentMethods) > 0)
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
                    @else
                        <div class="alert alert-info">
                            There are no payment methods.
                        </div>
                    @endif
                    <br>
                    <a href="{{ route('payment-methods.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Payment Method</a>
                </div>
            </div>
        </div>
    @endif
</div>
