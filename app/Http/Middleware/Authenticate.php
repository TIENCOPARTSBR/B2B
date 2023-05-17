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
            if(Auth::guard("distributor")->check()) 
            {
                return $next($request);
            } else {
                return to_route('distributor.login');
            }
            if(Auth::guard("admin")->check()) 
            {
                return $next($request);
            } else {
                return to_route('admin.login');
            }
        }

        return $next($request);
    }
}