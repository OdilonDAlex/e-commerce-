<?php

namespace App\Models;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'slug',
        'rate',
        'promo',
        'image',
        'updated_at',
    ];

    public function getImageUrl(): string|null {
        return Storage::disk('public')->url($this->image);
    }

    public function categories(): HasMany {
        return $this->hasMany(Category::class);
    }
}
