<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $plan->name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $plan->price }}</p>
</div>

<!-- Stripe Plan Id Field -->
<div class="form-group">
    {!! Form::label('stripe_plan_id', 'Stripe Plan Id:') !!}
    <p>{{ $plan->stripe_plan_id }}</p>
</div>

<!-- Billing Period Field -->
<div class="form-group">
    {!! Form::label('billing_period', 'Billing Period:') !!}
    <p>{{ $plan->billing_period }}</p>
</div>

