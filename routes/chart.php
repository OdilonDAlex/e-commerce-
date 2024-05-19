<?php

use App\Models\Income;
use Illuminate\Support\Facades\Route;


Route::get('/income/{days}', function(int $days){

    $incomes = Income::orderByDesc() 
});