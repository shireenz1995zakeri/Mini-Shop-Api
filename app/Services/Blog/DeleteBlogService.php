<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteBlogService
{
    public function __construct(public  BlogRepositoryInterface $repository)
    {

    }
    public function handle($eloquent)
    {
        return $this->repository->delete($eloquent);

    }
}
