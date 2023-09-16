<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
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
    public function definition()
    {
        return [
            'user_id'     => User::factory(),
            'title'=>fake()->name(),
            'body'=>fake()->name(),
            'category_id'=>Category::factory(),
            'brand_id'=>Brand::factory(),
            'published'=>fake()->boolean(),
            'inventory'=>fake()->numberBetween(),
            'price'=>rand(1000,10000),
        ];
    }
}
