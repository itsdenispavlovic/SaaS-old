@extends('layouts._frontend')

@section('content')
    <div class="container mb-5">
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
                        @livewire('checkout', ['plan' => $plan, 'countries' => $countries])
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
