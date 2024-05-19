<?php

use App\Http\Resources\IncomeResource;
use App\Models\Income;
use Illuminate\Support\Facades\Route;


/** @params $days Nombre de jour */
Route::get('/income/{days}', function(int $days=7){

    return IncomeResource::collection(Income::orderByDesc('created_at')->limit($days)->get());
});