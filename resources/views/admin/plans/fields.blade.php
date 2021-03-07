<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Stripe Plan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stripe_plan_id', 'Stripe Plan Id:') !!}
    {!! Form::text('stripe_plan_id', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Billing Period Field -->
<div class="form-group col-sm-6">
    {!! Form::label('billing_period', 'Billing Period:') !!}
    {!! Form::select('billing_period', \App\Models\Plan::BILLING_PERIODS, null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
</div>
