<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Product;
use App\Models\Product\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $today = Carbon::today();

        // recupération des données dans la base de données
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
        ->whereRaw('YEAR(incomes.created_at) = ' . $today->year + 1)
        ->first()
        ->total ?? null;

        $lastYearIncome = Income::selectRaw('sum(incomes.total) total')
        ->whereRaw('YEAR(incomes.created_at) = ' . $today->subYear()->year)
        ->first()
        ->total ?? null;

        // traitements 
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
    }
}
