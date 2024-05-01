<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'started_at',
        'end_at'
    ];

    public function products(): HasOne {
        return $this->hasOne(Product::class) ;
    }
}
