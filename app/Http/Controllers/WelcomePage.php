<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class WelcomePage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $best_seller = Product::all()->last();
        return view('welcome', [
            'weeks_product' => $best_seller, 
            'recommended_product' => Product::where('price', '>', 1000000)->limit(5),
            'products' => Product::paginate(6),
        ]);
    }
}
