<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;

class DeleteCategoryService
{
    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }
    public function handle($eloquent){
        return $this->repository->delete($eloquent);
    }

}
