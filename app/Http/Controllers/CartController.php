<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; 

class CartController extends Controller
{
    /** @var User $user */
    public  $user;
    public function __construct()
    {
        $this->user = Auth::user() ;
    }
    
    public function createCart(): Cart {
        $this->user->carts()->associate(Cart::create());
        $this->user->save();

        return $this->user->carts()->first();
    }

    public function index() {
        $cart = $this->user->carts()->first();
        if(null === $cart) {
            $cart = $this->createCart();
        }

        return view('cart.index', [
            'items' => $cart->items()->get(),
        ]);
    }

    public function add(Request $request){
        $request = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);
        
        $product = Product::find((int) $request['product_id']);

        $cart_item = $product->items()->create(['quantity' => (int)$request['quantity']]) ;

        $cart  = $this->user->carts()->first() ;

        if($cart === null) {
            $cart = $this->createCart();
        }
        $cart_item->carts()->associate($cart) ;

        $cart_item->save();

        return redirect()->route('home');
    }
}
