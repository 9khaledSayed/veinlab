<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "employee" && Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }
        if ($guard == "hospital" && Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }
        if ($guard == "patient" && Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
