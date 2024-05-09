<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\JoinClause;

class WelcomePage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   

        $bestPromos = Product::select('products.*')
            ->join('promos', function(JoinClause $join) {
                $join->on('promos.id', '=', 'products.promo_id');
            })
            ->limit(6)
            ->orderByDesc('promos.value')
            ->get();

        $category = Category::first();

        return view('welcome', [ 
            'products' => Product::paginate(9),
            'bestPromos' => $bestPromos,
            'categories' => Category::all(),
            'activeCategory' => $category === null ? Category::first() : $category,
        ]);
    }
}
