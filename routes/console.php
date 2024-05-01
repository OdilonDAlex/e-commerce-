<?php

use App\Notifications\ProfileUpdated;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Promo;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call( function () {
    $promos = DB::table('promos')->get() ;

    foreach($promos as $promo) {
        if(Carbon::now()->getTimestamp() > (new Carbon($promo->end_at))->getTimestamp()) {
            
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
})->everyTenSeconds();