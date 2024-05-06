<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        /** @var Product $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => number_format($this->price, '2', '.', ' '),
            'stock' => $this->stock,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->getImageUrl(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
