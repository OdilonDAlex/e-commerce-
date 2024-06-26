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
        'timeout',
        'stock_taken'
    ];

    use HasFactory;

    public function products(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function carts(): BelongsTo {
        return $this->belongsTo(Cart::class);
    }
}
