<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function redirectTo($request, $guards)
    {
        foreach($guards as $guard){
            if ($guard === 'distributor') {
                return route('distributor.login');
            }
            if ($guard === 'admin') {
                return route('admin.login');
            }
        }
    }
}