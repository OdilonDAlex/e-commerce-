<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promo;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(100)->create();

        foreach($products as $product){
            $product->promos()->associate(new Promo(['value' => fake()->randomDigitNotZero()*10, 'end_at' => Carbon::now()->addHours(fake()->randomNumber(4))]));
        }
    }
}
