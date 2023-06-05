<?php

namespace App\Http\Controllers\Distributor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    public function index()
    {
        return view('distributor.auth.login');
    }

    public function store(Request $request)
    {   
        if(Auth::guard('distributor')
            ->attempt([ 'mail' => $request->mail, 
                        'password' => $request->password, 
                        'is_active' => 1]))
        {   
            return redirect('/');
        }

        return redirect()
                ->action([LoginController::class,'index'])
                ->with('login', __('messages.Wrong email or password'));
    }

    public function logout(Request $request)
    {
        Auth::guard('distributor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->action([LoginController::class, 'index']);
    }
}