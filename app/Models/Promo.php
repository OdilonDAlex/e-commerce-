<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'end_at'
    ];

    public function products(): HasOne {
        return $this->hasOne(Product::class) ;
    }
}
