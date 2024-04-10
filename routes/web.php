<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})
->middleware('auth')
->name('home');

Route::middleware('auth')
->prefix('chat/')->name('chat.')->group( function () : void {
    
    Route::get('', [ChatController::class, 'index'])
        ->name('index');

    Route::post('create/', [ChatController::class, 'create'])
        ->name('create');
});




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';