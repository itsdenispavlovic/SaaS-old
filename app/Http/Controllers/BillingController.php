<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $currentPlan = Auth::user()->subscription('default') ?? NULL;
        return view('billing.index', compact('plans', 'currentPlan'));
    }

    public function cancelPlan()
    {
        Auth::user()->subscription('default')->cancel();

        return redirect()->route('billing');
    }

    public function resumePlan()
    {
        Auth::user()->subscription('default')->resume();

        return redirect()->route('billing');
    }
}
