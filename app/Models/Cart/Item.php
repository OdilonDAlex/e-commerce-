<?php

namespace App\Models\Cart;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $fillable = [
        'quantity',
    ];

    use HasFactory;

    public function products(): HasOne {
        return $this->hasOne(Product::class);
    }

    public function carts(): HasOne{
        return $this->hasOne(Cart::class);
    }
}
