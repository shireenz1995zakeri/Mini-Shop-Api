<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;

class UpdateBlogService
{
    private $mediauploader;

    public function __construct(public  BlogRepositoryInterface $repository,
                                public  MediaUploader          $mediaUploader)
    {

    }

    public function handle($eloquent, array $payload): Blog
    {
        $this->repository->update($eloquent, $payload);
        if (request()->hasFile('image')) {
            $res = $this->mediauploader->upload('images/blog');
            $eloquent->medias()->updateOrCreate([
                'url' => $res['url'],
            ]);
        }
        return $eloquent;
    }



}
