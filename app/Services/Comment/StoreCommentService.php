<?php

namespace App\Services\Comment;

use App\Models\Blog;
use App\Models\Comment;
use App\Traits\HasComment;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCommentService
{
    use HasComment;
    use AsAction;

    public function addComment($payload)
    {
        return DB::transaction(function () use($payload){

              if($payload['commmentable_type']=='product'){
                  $payload['commmentable_type']=Product::class;
              }
              elseif ($payload['commmentable_type']=='blog'){
                  $payload['commmentable_type']==Blog::class;
              }
              $model=$this->repoitory->store($payload);
              return $model;
        });
    }
}
