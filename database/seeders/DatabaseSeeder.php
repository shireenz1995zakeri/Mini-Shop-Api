<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\like;
use App\Models\Media;
use App\Models\Meta;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Product;
use App\Models\Translation;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
           // BrandSeeder::class,
            //ProductSeeder::class,
           // CartSeeder::class,
            //OrderSeeder::class,
           // BlogSeeder::class,

           // CategorySeeder::class
        ]);
    }
}
