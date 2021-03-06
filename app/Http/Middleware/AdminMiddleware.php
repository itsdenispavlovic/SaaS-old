<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->type !== "admin")
        {
            return redirect('/');
        }
        return $next($request);
    }
}
