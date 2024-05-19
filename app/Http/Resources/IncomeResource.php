<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = new Carbon($this->created_at);
        return [
            'date' => $date->format('Y-m-d'),
            'dayOfWeek' => $date->shortEnglishDayOfWeek,
            'total' => $this->total,
        ];
    }
}
