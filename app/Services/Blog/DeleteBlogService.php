<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBlogService
{
    use AsAction;
    public function __construct(public  BlogRepositoryInterface $repository)
    {

    }
    public function handle($eloquent)
    {
        return $this->repository->delete($eloquent);

    }
}
