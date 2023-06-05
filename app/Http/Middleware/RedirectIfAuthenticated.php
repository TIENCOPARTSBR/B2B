<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if(Auth::guard("direct-distributor")->check()) 
            {
                return redirect(RouteServiceProvider::DIRECTDISTRIBUTOR);
            }

            if(Auth::guard("distributor")->check()) 
            {
                return redirect(RouteServiceProvider::DISTRIBUTOR);
            }

            if(Auth::guard("admin")->check()) 
            {
                return redirect(RouteServiceProvider::ADMIN);
            }
        }
        return $next($request);
    }
}