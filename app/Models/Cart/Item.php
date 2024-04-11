<?php

namespace App\Models\Cart;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'quantity',
    ];

    use HasFactory;

    public function products(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function carts(): BelongsTo{
        return $this->belongsTo(Cart::class);
    }
}
