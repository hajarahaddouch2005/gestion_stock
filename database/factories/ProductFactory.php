<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
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
            'name'=>fake()->name(),
            'description'=> fake()->text(200),
            'price'=> fake()->randomFloat(2, 100,1000),
            'picture'=> fake()->imageUrl(),
            'supplier_id'=> Supplier::factory(),
            'category_id' => Category::factory()
        ];
    }
}
