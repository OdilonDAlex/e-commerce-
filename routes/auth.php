<?php

use App\Http\Controllers\auth\AuthenticateUserController;
use App\Http\Controllers\auth\RegisterUserController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group( function () {
    
    Route::get('/login', [AuthenticateUserController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthenticateUserController::class, 'store'])
        ->name('login.store');

    Route::get('/register', [RegisterUserController::class, 'register'])
        ->name('register');

    Route::post('/register', [RegisterUserController::class, 'store'])
        ->name('register.store');
});

Route::delete('/logout', [AuthenticateUserController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');