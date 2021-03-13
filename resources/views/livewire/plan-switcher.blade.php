<div>
    <div class="ml-4">
        @if(Session::has('message'))
            <div class="alert alert-info">
                {!! Session::get('message') !!}
            </div>
        @endif

        @if(is_null($currentPlan))
            You are now on Free Trial. Please choose plan to upgrade:
        @elseif($currentPlan->trial_ends_at)
            <div class="alert alert-info">
                Your trial will end on {{ $currentPlan->trial_ends_at->toDateString() }} and your card will be charged.
            </div>
        @endif
        <div class="row">
            <div class="col">
                <input type="radio" name="billing_period" value="monthly" wire:model="checked"> Monthly
                <input type="radio" name="billing_period" value="yearly" wire:model="checked"> Yearly
            </div>
        </div>
    </div>

    <hr>
    <div class="row flex vcenter mt-4 {{ ($checked == \App\Models\Plan::MONTHLY_PERIOD ? '' : 'd-none') }}" id="plans_monthly">
        @foreach($monthlyPlan as $plan)
            <x-plan-item :plan="$plan" :currentPlan="$currentPlan" :billingPeriod="$plan->billing_period"></x-plan-item>
        @endforeach
    </div>
    <div class="row {{ ($checked == \App\Models\Plan::YEARLY_PERIOD ? '' : 'd-none') }}" id="plans_yearly">
        @foreach($yearlyPlan as $plan)
            <x-plan-item :plan="$plan" :currentPlan="$currentPlan" :billingPeriod="$plan->billing_period"></x-plan-item>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('swal:confirm-cancel', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('cancel', event.detail.id);
                }
            })
        });

        window.addEventListener('swal:confirm-resume', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('resume');
                }
            })
        });

        window.addEventListener('swal:confirm-select', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('select', event.detail.id);
                }
            })
        });
    </script>
@endpush
