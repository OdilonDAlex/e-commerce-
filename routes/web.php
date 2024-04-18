<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomePage::class)->name('home');

Route::middleware('auth')
->prefix('chat/')->name('chat.')->group( function () : void {
    
    Route::get('', [ChatController::class, 'index'])
        ->name('index');

    Route::post('create/', [ChatController::class, 'create'])
        ->name('create');
});


Route::get('product/show/{slug}', [ProductController::class, 'show'])
    ->name('product.show');


Route::middleware('auth')->prefix('cart/')->name('cart.')
->group( function (): void {

    Route::get('', [CartController::class, 'index'])
        ->name('index');

    Route::post('add', [CartController::class, 'add'])
        ->name('add');

    Route::delete('remove-item', [CartController::class, 'remove'])
        ->name('remove-item');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';