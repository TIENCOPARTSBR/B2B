<?php

namespace App\Http\Middleware;

use App\Models\Distributors;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if($guard === "distributor")
            {
                if(Auth::guard($guard)->check()) 
                {
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }

            if($guard === "admin")
            {
                if(Auth::guard($guard)->check()) 
                {
                    return $next($request);
                } else {
                    return redirect('/admin');
                }
            }
        }

        return $next($request);
    }
}