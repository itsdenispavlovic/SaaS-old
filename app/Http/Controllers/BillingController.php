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
        $currentPlan = Auth::user()->subscription('default')->stripe_plan ?? NULL;
        return view('billing.index', compact('plans', 'currentPlan'));
    }
}
