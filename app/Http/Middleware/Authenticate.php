<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {   
        foreach($guards as $guard){
            if($guard === "direct-distributor") {
                if(Auth::guard($guard)->check()) {
                    return $next($request);
                } else {
                    return to_route('direct.distributor.login');
                }
            }

            if($guard === "distributor") {
                if(Auth::guard($guard)->check()) {
                    return $next($request);
                } else {
                    return to_route('distributor.distributor.login');
                }
            }

            if($guard === "admin") {
                if(Auth::guard($guard)->check()) {
                    return $next($request);
                } else {
                    return to_route('admin.login');
                }
            }
        }

        return $next($request);
    }
}