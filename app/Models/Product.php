<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

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
}
