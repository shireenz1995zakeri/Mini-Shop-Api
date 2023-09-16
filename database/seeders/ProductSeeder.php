<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\like;
use App\Models\Product;
use App\Models\User;
use Database\Factories\LikeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::factory(1)->create();
        Product::factory(10)
            ->create()
            ->each(function (Product $product) use($user){
                Comment::factory(1)
                    ->create([
                        'user_id'          => $user->id,
                        'commentable_id'=>$product->id,
                        'commentable_type'=>Product::class,

                    ])->each(function (Comment $comment) use($user){
                        Like::factory(1)
                            ->create([
                                'user_id'          => $user->id,
                                'likeable_id'=>$comment->id,
                                'likeable_type'=>Comment::class,
                            ]);

                    });
                Media::factory(1)
                ->create([
                    'mediaable_type'=>Product::class,
                    'mediaable_id'=>$product->id,

                ]);
            });

    }
}
