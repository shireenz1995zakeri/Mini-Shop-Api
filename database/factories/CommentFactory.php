<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => fake()->text,
            //'user_id'=> User::factory(),
            'parent_id'=> null,
            'published'=> rand(0,1),

        ];
    }
}
