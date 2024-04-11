<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cart\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function carts(): HasMany {
        return $this->hasMany(Item::class);
    }

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}   
