<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomePage;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', WelcomePage::class)->name('home');

Route::middleware('auth')
->prefix('chat/')->name('chat.')->group( function () : void {
    
    Route::get('', [ChatController::class, 'index'])
        ->name('index');

    Route::post('create/', [ChatController::class, 'create'])
        ->name('create');

    Route::get('messages/{userId}', [ChatController::class, 'messagesWith'])
        ->name('messages.with');
});


Route::get('product/show/{slug}', [ProductController::class, 'show'])
    ->name('product.show');

Route::get('search/', [ProductController::class, 'search'])
    ->name('search');

Route::middleware('auth')->prefix('cart/')->name('cart.')
->group( function (): void {

    Route::get('', [CartController::class, 'index'])
        ->name('index');

    Route::post('add', [CartController::class, 'add'])
        ->name('add');

    Route::delete('remove-item', [CartController::class, 'remove'])
        ->name('remove-item');
    
    Route::post('buy', [CartController::class, 'buy'])
        ->name('buy');
});

Route::prefix('profile/')->name('profile.')
->middleware('auth')
->group(function (): void {
    
    Route::get('', [ProfileController::class, 'index'])
        ->name('index') ;
        
    Route::patch('update', [ProfileController::class, 'update'])
        ->name('update') ;
});

Route::get('/users/authenticated/ids', function() {
    return json_encode(array_unique(DB::table(config('session.table'))
        ->select('user_id')
        ->get()
        ->pluck('user_id')
        ->toArray()))
        ;
});

Route::get('/auth/', function() {
    return json_encode(Auth::check() ? ['id' => Auth::user()->id, 'role' => Auth::user()->role ] : ['id' => -1, 'role' => 'guest']);
});

Route::get('history/', HistoryController::class)
    ->name('history');

Route::get('produt/', [ProductController::class, 'productIndex'])
    ->name('product.index') ;

Route::get('checkout/', function(){
    return view('cart.checkout');
})
->middleware('auth')
->name('checkout');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';