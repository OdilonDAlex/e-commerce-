<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart\Item;
use App\Models\Income;
use App\Models\Product;
use App\Notifications\ProductAddedToCart;
use Carbon\Carbon;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;

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

        if($product->stock < (int) $request['quantity']) {
            return redirect()->route('home');
        }

        $cart_item = $product->items()->create([
            'quantity' => (int)$request['quantity'],
            'timeout' => Carbon::now()->addHour(),
            'stock_taken'  => false,
        ]) ;

        $product->stock -= (int) $cart_item->quantity;
        $cart_item->stock_taken = true;
        $product->save();

        $cart  = $this->user->carts()->first() ;

        if($cart === null) {
            $cart = $this->createCart();
        }
        $cart_item->carts()->associate($cart) ;


        $cart_item->save();

        /** @var User $authenticatedUser */
        $authenticatedUser = Auth::user() ;
        $authenticatedUser->notify(new ProductAddedToCart($cart_item));

        return redirect()->route('home');
    }

    public function remove(Request $request){
       $validated = $request->validate([
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'product_name' => ['required', 'string', 'exists:products,name']
       ]);
       
       $item = Item::find((int) $validated['item_id']);
        if($item !== null){
            $product = Product::find( (int) ($item->product_id));
            $product->stock += (int) $item->quantity;
            $item->products()->dissociate();
            $item->carts()->dissociate();
            $item->delete();
            $product->save();

            return redirect()->route('cart.index')
                ->with('item-removed-to-cart', 'Le Produit ' . $validated['product_name'] . ' a bien été retiré de votre panier');
        }

        return redirect()->route('cart.index')
            ->with('item-not-removed-to-cart', 'Une erreur s\'est produite lors du suppression');
    }


    public function buy(){

        $todayIncome = Income::whereRaw('DATE_FORMAT(DATE(incomes.created_at), "%Y-%m-%d") = "' . Carbon::today()->format('Y-m-d') . '"')->first();

        if($todayIncome === null){
            $todayIncome = Income::create();
        }
        
        $result = [];


        $items = Auth::user()->carts()->first()->items()->get();
        
        foreach($items as $item){

            $relatedProduct = $item->products()->first();
            $promo = $relatedProduct->promos()->first();
            if(! $item->stock_taken){

                if($relatedProduct->stock >= $item->quantity){
                    $relatedProduct->stock -= $item->quantity;
                    $relatedProduct->selled += $item->quantity;

                    try{
                        try {
                            $todayIncome->total += $relatedProduct->getPrice() * $item->quantity;
                        }
                        catch(Exception $priceNull){;}
                    }
                    catch(Exception $priceNull){;}

                    $item->products()->dissociate();
                    $item->carts()->dissociate();
                    $item->delete();
                }
                else {
                    $result['message'] = 'Stock incomplète';
                }

            } else {
                try {
                    $todayIncome->total += $relatedProduct->getPrice() * $item->quantity;
                }
                catch(Exception $priceNull){;}
                
                $relatedProduct->selled += $item->quantity;
                $item->products()->dissociate();
                $item->carts()->dissociate();
                $item->delete();
            }

            $relatedProduct->save();
        }
        
        $todayIncome->save();

        $result['success'] = 'Ok';

        return json_encode($result);        
    }
}
