<?php

namespace App\Http\Controllers\Distributors\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{   
    public function login()
    {
        if(View::exists('distributor.auth.login'))
        {
            return view('distributor.auth.login');
        }
        abort(Response::HTTP_NOT_FOUND);
    }

    public function processLogin(Request $r)
    {   
        if(Auth::guard('distributor')->attempt(['mail' => $r->mail, 'password' => $r->password, 'is_active' => 1]))
        {   
            return redirect('/');
        }

        return redirect()->action([
            LoginController::class,
            'login'
        ])->with('login', __('messages.Wrong email or password'));
    }

    public function logout(Request $request)
    {
        Auth::guard('distributor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->action([ LoginController::class, 'login' ]);
    }
}