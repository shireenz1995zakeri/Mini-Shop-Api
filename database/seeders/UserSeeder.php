<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(10)
            ->create()
            ->each(function (User $user) {
                Blog::factory(1)->create([
                    'user_id' => $user->id,
                ])->each(function (Blog $blog) use ($user) {
                    View::factory(1)->create([
                        'user_id' => $user->id,
                        'viewable_type' => Blog::class,
                        'viewable_id' => $blog->id,
                    ]);
                });


                Blog::factory(1)->create([
                    'user_id' => $user->id,
                ])->each(function (Blog $blog) use ($user) {
                    Comment::factory(1)->create([
                        'user_id' => $user->id,
                        'commentable_type' => Blog::class,
                        'commentable_id' => $blog->id,
                    ])->each(function (Comment $comment) use ($user) {
                        Like::factory(1)->create([
                            'user_id' => $user->id,
                            'likeable_id' => $comment->id,
                            'likeable_type' => Comment::class,
                        ]);
                    });
                });

//start of product seeder
                Product::factory(10)->create([
                    'user_id' => $user->id,
                ])->each(function (Product $product) use ($user) {
                    Comment::factory(1)->create([
                        'user_id' => $user->id,
                        'commentable_id' => $product->id,
                        'commentable_type' => Product::class,
                    ]);
                });
//end of product seeder

//start of oeder seeder
                Order::factory(10)->create(
                    [
                        'user_id'=>$user->id,
                    ])
                    ->each(function (Order $order) {
                        OrderItem::factory(2)->create([
                            'order_id' => $order->id,
                        ]);
                    });
//end of seederOrder
//                start of carts seeder
                Cart::factory(10)->create([
                    'user_id'=>$user->id,

                ]);

//                end of carts seeder
            });
    }
}
