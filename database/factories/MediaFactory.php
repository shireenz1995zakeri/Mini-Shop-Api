<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mediaable_type' => fake()->randomElement([Product::class , Blog::class,User::class]),
            'mediaable_id' => rand(1,10),
            'url' => fake()->url,
            'extension' => fake()->randomElement(['pdf' ,'jpeg', 'jpg']),
            'size' => rand(1,3),


        ];
    }
}
