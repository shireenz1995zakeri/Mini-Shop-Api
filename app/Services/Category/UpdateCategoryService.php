<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;


class UpdateCategoryService
{
    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }

    public function handle($eloquent, array $payload):Category
    {
       return DB::transaction(function () use($eloquent,$payload){
           $this->repository->update($eloquent,$payload);
           return  $eloquent;
       });
    }

}
