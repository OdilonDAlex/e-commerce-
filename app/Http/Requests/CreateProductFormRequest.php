<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categories_id' => ['nullable', 'array'],
            'name' => ['required', 'string', 'min:2'],
            'price' => ['required', 'decimal:0,10'],
            'stock' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'rate' => ['nullable', 'decimal:0,10', 'min:0', 'max:5'],
            'promo' => ['nullable', 'decimal:0,10', 'min:0', 'max:100'],
            'promo_expired_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:10000'],
        ];
    }
}
