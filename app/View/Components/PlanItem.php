<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PlanItem extends Component
{
    public $plan;
    public $currentPlan;
    public $billingPeriod;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($plan, $currentPlan, $billingPeriod)
    {
        $this->plan = $plan;
        $this->currentPlan = $currentPlan;
        $this->billingPeriod = $billingPeriod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.plan-item');
    }
}
