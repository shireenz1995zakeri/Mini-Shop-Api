<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(1)->create()
            ->each(function (Category $category){
            Translation::factory(1)->create([

                'translatable_id' => $category->id,
                'translatable_type' => Category::class,

            ]);
        } );
    }
}
