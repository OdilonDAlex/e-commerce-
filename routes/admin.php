<?php

use App\Http\Controllers\AdminDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Income;
use App\Models\Product;
use App\Models\Product\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;


Route::middleware('auth')->prefix('admin/')->name('admin.')
->group( function (): void {
        
    Route::get('', AdminDashboard::class)->name('dashboard');

    // route pour les produits
    Route::prefix('product/')->name('product.')->group( function (): void {

        Route::get('create/', [ProductController::class, 'create'])
            ->name('create');
    
        Route::post('store/', [ProductController::class, 'store'])
            ->name('store');
    
        Route::get('edit/{product_id}', [ProductController::class, 'edit'])
            ->name('edit');
    
        Route::post('update/{product_id}', [ProductController::class, 'update'])
            ->name('update');

        Route::get('', [ProductController::class, 'index'])
            ->name('index');

        Route::get('category/create', function(): View {
            return view('admin.product.category.create');
        });
        
        Route::post('category/create', [ProductController::class, 'create_category'])
            ->name('category.create');

        Route::delete('delete/', [ProductController::class, 'delete'])
            ->name('delete');

        Route::get('/stock-out', [ProductController::class, 'productStockOut'])
            ->name('stock.out');
    });
});
