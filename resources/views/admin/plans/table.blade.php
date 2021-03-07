<div class="table-responsive-sm">
    <table class="table table-striped" id="plans-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Price</th>
        <th>Stripe Plan Id</th>
        <th>Billing Period</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->name }}</td>
            <td>{{ $plan->price }}</td>
            <td>{{ $plan->stripe_plan_id }}</td>
            <td>{{ $plan->billing_period }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.plans.destroy', $plan->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.plans.show', [$plan->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.plans.edit', [$plan->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>