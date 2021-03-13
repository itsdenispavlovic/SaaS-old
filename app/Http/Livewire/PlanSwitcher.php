<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PlanSwitcher extends Component
{
    public $monthlyPlan;
    public $yearlyPlan;
    public $currentPlan = NULL;

    public $checked = 'monthly';

    protected $listeners = [
        'cancel',
        'resume',
        'select'
    ];

    public function mount()
    {
        $this->refreshChecked();
    }

    public function refreshChecked()
    {
        if(Auth::check())
        {
            $this->currentPlan = Auth::user()->subscription('default') ?? NULL;
            $currentStripePlan = (!empty($this->currentPlan) ? $this->currentPlan->stripe_plan : NULL);
            if(!empty($currentStripePlan))
            {
                $plan = Plan::where('stripe_plan_id', $currentStripePlan)->first();

                if(!empty($plan))
                {
                    $this->checked = $plan->billing_period;
                }
            }
        }
    }

    public function cancelPlan($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-cancel', [
            'type' => 'warning',
            'title' => 'Are you sure, you want to cancel?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function cancel($id)
    {
        $user = Auth::user();
        $subscription = $user->subscription('default');
        if(!$subscription->cancelled() && !$subscription->onGracePeriod())
        {
            try {
                $subscription->cancel();
                Log::info('Subscription canceled.');
            } catch (Exception $e)
            {
                Log::critical($e->getMessage());
            }
        }

        $this->refreshChecked();
    }

    public function resumePlan()
    {
        $this->dispatchBrowserEvent('swal:confirm-resume', [
            'type' => 'warning',
            'title' => 'Are you sure, you want to resume?',
            'text' => '',
        ]);
    }

    public function resume()
    {
        $user = Auth::user();
        $subscription = $user->subscription('default');
        if($subscription->cancelled() && $subscription->onGracePeriod())
        {
            try {
                $subscription->resume();
                Log::info('Subscription resumed.');
            } catch(Exception $e)
            {
                Log::critical($e->getMessage());
            }
        }

        $this->refreshChecked();
    }

    public function selectPlan($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-select', [
            'type' => 'warning',
            'title' => 'Are you sure, you want to select this plan?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function select($id)
    {
        if(Auth::check())
        {
            $plan = Plan::find($id);
            $currentPlan = Auth::user()->subscription('default')->stripe_plan ?? NULL;

            if (!is_null($currentPlan) && $currentPlan != $plan->stripe_plan_id) {
                // Change the subscription
                try {
                    Auth::user()->subscription('default')->swap($plan->stripe_plan_id);
                    Log::info('Subscription changed to: ' . $plan->name);
                } catch (Exception $e) {
                    Log::critical($e->getMessage());
                }
                $this->refreshChecked();
            }
            else
            {
                return redirect()->route('checkout', $plan->id);
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->monthlyPlan = Plan::where('billing_period', Plan::MONTHLY_PERIOD)->get();
        $this->yearlyPlan = Plan::where('billing_period', Plan::YEARLY_PERIOD)->get();

        return view('livewire.plan-switcher');
    }
}
