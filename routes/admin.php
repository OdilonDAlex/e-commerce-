<?php
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
        
    Route::get('', function(){
        $today = Carbon::today();

        $todayIncome = Income::whereRaw('DATE_FORMAT(DATE(incomes.created_at), "%Y-%m-%d") = "' . $today->format('Y-m-d') . '"')->first()->total ?? null;

        $yesterdayIncome = Income::whereRaw('DATE_FORMAT(DATE(incomes.created_at), "%Y-%m-%d") = "' . $today->subDay()->format('Y-m-d') . '"')->first()->total ?? null;

        $thisMonthIncome = Income::selectRaw('sum(incomes.total) total')
        ->whereRaw('YEAR(created_at)-MONTH(created_at) = ' . $today->format('Y-m'))
        ->first()
        ->total ?? null;

        $lastMonthIncome = Income::selectRaw('sum(incomes.total) total')
        ->whereRaw('YEAR(created_at)-MONTH(created_at) = ' . $today->subMonth()->format('Y-m'))
        ->first()
        ->total ?? null;

        $thisYearIncome = Income::selectRaw('sum(incomes.total) total')
        ->whereRaw('YEAR(incomes.created_at) = ' . $today->year)
        ->first()
        ->total ?? null;

        $lastYearIncome = Income::selectRaw('sum(incomes.total) total')
        ->whereRaw('YEAR(incomes.created_at) = ' . $today->subYear()->year)
        ->first()
        ->total ?? null;

        $dayDifference = (int)(100 * $todayIncome / (( $yesterdayIncome ?? $todayIncome ) == 0 ? 1 :  ( $yesterdayIncome ?? $todayIncome)) ) - 100;

        
        $monthDifference = (int)(100 * $thisMonthIncome / (( $lastMonthIncome ?? $thisMonthIncome ) == 0 ? 1 : ( $lastMonthIncome ?? $thisMonthIncome )) ) - 100;

        $yearDifference = (int)(100 * $thisYearIncome / (( $lastYearIncome ?? $thisYearIncome ) == 0 ? 1 : ( $lastYearIncome ?? $thisYearIncome )) ) - 100;
        

        return view('admin.dashboard', [
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'unavaible_products' => Product::where('stock', 0)->count(),

            'day_income' => number_format($todayIncome ?? 0, 2) . "Ar",
            
            'day_difference' => $dayDifference,

            'month_income' => number_format($thisMonthIncome ?? 0, 2) . "Ar",

            'month_difference' => $monthDifference,

            'year_income' => number_format($thisYearIncome ?? 0, 2) . "Ar",
            
            'year_difference' => $yearDifference,
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

        Route::get('/stock-out', [ProductController::class, 'productStockOut'])
            ->name('stock.out');
    });
});
