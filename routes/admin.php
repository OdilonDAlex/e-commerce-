<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::middleware('auth')->prefix('admin/')->name('admin.')
    ->group( function (): void {

    // route pour les produits
    Route::prefix('product/')->name('product.')->group( function (): void {

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

        Route::get('', [ProductController::class, 'index'])
            ->name('index');
    });
});