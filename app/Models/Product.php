<?php

namespace App\Models;

use App\Models\Cart\Item;
use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'promo_id',
        'image',
        'updated_at',
    ];

    public function getImageUrl(): string|null {
        if(! $this->haveImage()){
            $this->image = 'product-default-image.jpg';
            
            $this->save();

            return Storage::disk('public')->url('product-default-image.jpg');
        }
        return Storage::disk('public')->url($this->image);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function items(): hasMany {
        return $this->hasMany(Item::class, 'product_id');
    }

    public function haveImage(): bool {
        if($this->image === null){
            return false;
        }
        
        return Storage::disk('public')->exists($this->image);
    }

    public function promos(): BelongsTo {
        return $this->belongsTo(Promo::class, 'promo_id') ;
    }
}
