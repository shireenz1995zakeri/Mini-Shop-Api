<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Carbon\Carbon;

class BlogService
{
    public function __construct(public  BlogRepositoryInterface $repository,
                                private  MediaUploader  $mediauploader)
    {
    }
//store
    public function store($payload): Blog
    {
        return DB::transaction(function () use ($payload) {
            $payload['user_id'] = auth()->id();
            //$model=Blog::create($payload);
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')) {
                $res = $this->mediauploader->upload();
                $model->medias()->create([
                    'url' => $res['url'],
                ]);
            }
            return $model;

        });


    }


//    update
    public function update($eloquent, array $payload): Blog
    {
        $this->repository->update($eloquent, $payload);
        if (hasFile('image')) {
            $res = $this->mediauploader->upload('images');
            $eloquent->medias()->update([
                'url' => $res['url'],
            ]);
        }
        return $eloquent;
    }

    public function removeLastBlogsByDate()
    {
        return DB::transaction(function () {
            $data=$this->repository->getBlogsByDate(Carbon::now()->subYear());
            foreach ($data as $item) {
                $item->medais()->delete();
                $item->delete();
            }
        });
    }
}
