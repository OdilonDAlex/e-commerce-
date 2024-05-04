<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 100, 10000000),
            'stock' => fake()->randomNumber(4),
            'description' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'image' => fake()->image(),
        ];
    }
}
