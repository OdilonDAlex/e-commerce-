<?php

use App\Notifications\ProfileUpdated;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {

    DB::table('notifications')->get() ;
    echo "Hello, world" ;
})
->onFailure(function ($obj) {
    echo $obj;
})
->everyTenSeconds();