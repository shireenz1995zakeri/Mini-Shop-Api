<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class StoreBlogService
{
    public function __construct(public  BlogRepositoryInterface $repository,
    private  MediaUploader $mediaUploader)
    {

    }
//    store data of blog
    public function handle($payload): Blog
    {
        return DB::transaction(function () use ($payload) {
           // $payload['user_id'] = auth()->id();
            //$model=Blog::create($payload);
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')) {
                $res = $this->mediaUploader->upload('images/blogs');
                $model->medias()->create([
                    'url' => $res['url'],
                    'extension'=>$res['extension'],
                    'size'=>$res['size'],
                ]);
            }
            return $model;

        });//end of transaction

    }//end of handle




}
