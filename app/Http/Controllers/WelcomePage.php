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
        return view('welcome', [ 
            'products' => Product::paginate(9),
            'bestPromo' => Product::where('promo', '>', '0')->orderBy('promo')->first(),
        ]);
    }
}
