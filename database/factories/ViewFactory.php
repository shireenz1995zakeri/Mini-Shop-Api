<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\View>
 */
class ViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //'user_id' => User::factory(),
            'viewable_type' => '',
            'viewable_id' => '',
            //'view_count'=>rand(1,100),
            'ip'=>Str::random(10),
        ];
    }
}
