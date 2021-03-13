@extends('layouts._frontend')

@section('content')
    <section class="section is-sm section-plans pt-1">
        <img class="section-particle top-0" src="../assets/images/others/particle.svg" alt="">
        <div class="container mt-0">
            @livewire('plan-switcher')
        </div>

        @livewire('payment-methods')

        @if(Auth::check())
            @livewire('payment-history')
        @endif
        <br>
    </section>
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
