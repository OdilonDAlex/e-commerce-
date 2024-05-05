<?php

namespace App\Http\Controllers;

use App\Models\Cart\Item;
use App\Models\Product;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;

class WelcomePage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $category = Category::where('name', 'legumes')->get()->first() ;
        $bestPromos = array_keys(Promo::select('id')->where('value', '>', 0)->orderByDesc('value')->limit(6)->pluck('id', 'id')->toArray());
        return view('welcome', [ 
            'products' => Product::paginate(9),
            'bestPromos' => Product::whereRaw('promo_id in ('. implode(', ', $bestPromos) . ')')->get(),
            'categories' => Category::all(),
            'activeCategory' => $category === null ? Category::first() : $category,
        ]);
    }
}
