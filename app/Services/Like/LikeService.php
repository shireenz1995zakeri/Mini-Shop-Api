<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Traits\HasLike;
class LikeService
{
    use HasLike;
    public function addLike($model)
    {


        if (\Auth::user())
        {
            $like = Like::where('user_id', auth()->user()->id)
                ->where('likeable_type', $model::class)
                ->where('likeable_id', $model->id)
                ->first();

            if ($like) {
                $like->delete();
                echo 'delete successfully';
            } else {

                $model->likes()->create([
                    'user_id' => auth()->user()->id,
                ]);
                  echo 'ok';
            }
        }
        else {
            echo 'برای لایک باید وارد سایت شوید';
        }
    }
}
