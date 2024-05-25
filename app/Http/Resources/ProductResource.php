<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'name' => htmlspecialchars_decode($this->name),
            'price' => number_format($this->price, '2', '.', ' '),
            'stock' => $this->stock,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->getImageUrl(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'selled' => $this->selled,
        ];
    }
}
