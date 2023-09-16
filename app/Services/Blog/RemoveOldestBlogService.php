<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;
use Carbon\Carbon;

class RemoveOldestBlogService
{
    public function __construct(public readonly BlogRepositoryInterface $repository)
    {

    }
    public function handle()
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
