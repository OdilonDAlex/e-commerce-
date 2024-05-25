<?php

use App\Http\Resources\IncomeResource;
use App\Http\Resources\ProductResource;
use App\Models\Income;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


/** @params $days Nombre de jour */
Route::get('/income/{days}', function(int $days=7){
    
    return IncomeResource::collection(Income::orderByDesc('created_at')->limit($days)->get());
});

/** @params $product Nombre de produit */
Route::get('/top-selled-products/{product}', function(int $product=5){

    return ProductResource::collection(Product::where('selled', '>', 0)->orderByDesc('selled')->limit($product)->get());
});

/** @params $product Nombre de produit */
Route::get('/top-products-income/{product}', function(int $product=5){

    return ProductResource::collection(Product::where('selled', '>', 0)->orderByDesc('selled')->limit($product)->get());
});