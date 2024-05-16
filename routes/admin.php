<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Product\Category;
use App\Models\User;
use Illuminate\View\View;

Route::middleware('auth')->prefix('admin/')->name('admin.')
    ->group( function (): void {

    Route::get('', function(){
        return view('admin.dashboard', [
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'unavaible_products' => Product::where('stock', 0)->count(),
        ]);
    })->name('dashboard');

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
    });
});
