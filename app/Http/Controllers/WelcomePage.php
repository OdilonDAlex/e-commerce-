<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class WelcomePage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $category = Category::where('name', 'legumes')->get()->first() ;
        return view('welcome', [ 
            'products' => Product::paginate(9),
            // 'bestPromos' => Product::where('promo', '>', '0')->orderByDesc('promo')->limit(3)->get(),
            'bestPromos' => Product::all(),
            'categories' => Category::all(),
            'activeCategory' => $category === null ? Category::first() : $category,
        ]);
    }
}
