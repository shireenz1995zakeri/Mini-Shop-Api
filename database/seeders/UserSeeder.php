<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Translation;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{

    /**
     *
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admins = User::factory(10)
            ->create();


        foreach ($admins as $admin) {


            Media::factory(1)->create([
                'mediaable_id' => $admin->id,
                'mediaable_type' => User::class,
            ]);


            Blog::factory(1)->create([
                'user_id' => $admin->id,
                'created_at' => Carbon::now()->subDay(rand(1, 100))
            ])->each(function (Blog $blog) use ($admin) {
                Translation::factory(1)->create([

                    'translatable_id' => $blog->id,
                    'translatable_type' => Blog::class,

                ]);
                Like::factory(1)->create([
                    'user_id' => $admin->id,
                    'likeable_id' => $blog->id,
                    'likeable_type' => Blog::class,
                ]);
                View::factory(1)->create([
                    'user_id' => $admin->id,
                    'viewable_id' => $blog->id,
                    'viewable_type' => Blog::class,
                ]);
                Comment::factory(rand(1, 10))->create([
                    'user_id' => $admin->id,
                    'commentable_type' => Blog::class,
                    'commentable_id' => $blog->id,
                ])->each(function (Comment $comment) use ($admin) {
                    Like::factory(1)->create([
                        'user_id' => $admin->id,
                        'likeable_id' => $comment->id,
                        'likeable_type' => Comment::class,
                    ]);
                });
            });

//start of product seeder
            Product::factory(1)->create([

                'user_id' => $admin->id,
                'created_at' => Carbon::now()->subDay(rand(1, 100)),
            ])->each(function (Product $product) use ($admin) {

                Translation::factory(1)->create([

                    'translatable_id' => $product->id,
                    'translatable_type' => Product::class,

                ]);
                Comment::factory(rand(1, 8))->create([
                    'user_id' => $admin->id,
                    'commentable_id' => $product->id,
                    'commentable_type' => Product::class,
                ]);
                Like::factory(1)->create([
                    'user_id' => $admin->id,
                    'likeable_id' => $product->id,
                    'likeable_type' => Product::class,
                ]);
                View::factory(rand(1, 8))->create([
                    'user_id' => $admin->id,
                    'viewable_id' => $product->id,
                    'viewable_type' => Product::class,
                ]);

            });
//end of product seeder


//start of oeder seeder
            //               Order::factory(10)->create(
//                    [
//                        'user_id'=>$admin->id,
//                    ]);
//                    ->each(function (Order $order) {
//                        OrderItem::factory(2)->create([
//                            'order_id' => $order->id,
//                        ]);
//                    });
//end of seederOrder
//                start of carts seeder
//                Cart::factory(10)->create([
//                    'user_id'=>$admin->id,
//
//                ]);

//                end of carts seeder

        }


        //START BRAND
        $brands = Brand::all();
        foreach ($brands as $brand) {
            Translation::factory(1)->create([

                'translatable_id' => $brand->id,
                'translatable_type' => Brand::class,

            ]);
        }
        //START CATEGORY
        $categories = Category::all();

        foreach ($categories as $category) {
            Translation::factory(1)->create([

                'translatable_id' => $category->id,
                'translatable_type' => Category::class,

            ]);
        }
    }
}
