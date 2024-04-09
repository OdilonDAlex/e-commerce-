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

Route::middleware('auth')
->prefix('product/')->name('product.')->group( function (): void {

    Route::get('create/', [ProductController::class, 'create'])
        ->name('create');

    Route::post('store/', [ProductController::class, 'store'])
        ->name('store');
        
    Route::get('show/{slug}', [ProductController::class, 'show'])
        ->name('show');

    Route::get('edit/{product_id}', [ProductController::class, 'edit'])
        ->name('edit');

    Route::post('update/{product_id}', [ProductController::class, 'update'])
        ->name('update');
});

require __DIR__ . '/auth.php';