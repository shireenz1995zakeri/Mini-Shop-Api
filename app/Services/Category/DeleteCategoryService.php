<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCategoryService
{
    use AsAction;

    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }
    public function handle($eloquent){
        return $this->repository->delete($eloquent);
    }

}
