<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Promo;
use App\Models\Cart\Item;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call( function () {
    $promos = DB::table('promos')->get() ;

    foreach($promos as $promo) {
        if(Carbon::now()->getTimestamp() >= (new Carbon($promo->end_at))->getTimestamp()) {
            
            try {
                $product = Product::where('promo_id', $promo->id)->first();
                $product->promos()->dissociate();
            }
            catch(Exception $error){
                echo $error->getMessage(); 
            }
            $product->save();
            Promo::destroy($promo->id) ;

        }
    }
})
->name('delete_expired_promo')
->everySixHours();

Schedule::call(function () {
    $items_id = DB::table('items')->pluck('id');

    foreach($items_id as $id) {
        try {
            $item = Item::find((int)$id);
        }
        catch(Exception $error) {
            continue;
        }

        // a supprimé plus tard
        if($item->timeout === null && $item->id != 30) { continue; }
        
        if((Carbon::now()->getTimestamp() >= (new Carbon($item->timeout))->getTimestamp()) && $item->stock_taken == true) {

            try {

                $product = Product::find( (int) $item->product_id);
                $product->stock += $item->quantity;
                $item->stock_taken = false;

                $product->save();
                $item->save();
            }
            catch(Exception $error){
                echo $error->getMessage();
            }
        }
    }
})
->name('check_cart_item_timeout')
->everyTwoSeconds();