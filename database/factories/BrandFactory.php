<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Services\Translation\TranslationService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [

            ];
    }

//    public function configure()
//    {
//
//        $this->afterCreating(function (Brand $brand) {
//           TranslationService::translate($brand, [
//               'fa' => [
//                   'title' => fake()->title,
//               ]
//           ]);
//        });
//    }
}
