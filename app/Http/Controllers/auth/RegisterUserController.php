<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterUserController extends Controller
{
    

    public function register() {
        return view('guest.register');
    }

    public function store(RegisterFormRequest $request) {
        
        $credentias = $request->validated();

        $user = User::create([
            'name' => $credentias['name'],
            'email' => $credentias['email'],
            'password' => Hash::make($credentias['password'])
        ]);

        $cart = $user->carts()->create();

        $user->carts()->associate($cart);

        $user->save();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('new_user', 'Bienvenue ' . $user->name);
    }
}
