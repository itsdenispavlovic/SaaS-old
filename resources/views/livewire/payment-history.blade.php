<div>
    <section class="container mt-5">
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
                                <td>${{ $payment->total }}</td>
                                <td>
                                    <a href="{{ route('invoices.download', $payment->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-cloud-download-alt mr-2"></i> Download invoice</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        There are no payments made.
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
