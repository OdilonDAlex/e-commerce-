<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Cart\Item;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function items(): BelongsToMany {
        return $this->belongsToMany(Item::class);
    }

    public function users(): hasOne {
        return $this->hasOne(User::class);
    }
}   
