<?php

namespace App\Http\Controllers\auth;

use App\Events\NewUserConnected;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticateUserController extends Controller
{
    

    public function login() {
        return view('auth.login');
    }

    public function store(LoginFormRequest $request) {
        
        $request->authenticate();

        $request->session()->regenerate();


        NewUserConnected::dispatch(Auth::user());
        return redirect()->intended();
    }

    public function logout(Request $request) {
        
        Auth::logout(); 

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
