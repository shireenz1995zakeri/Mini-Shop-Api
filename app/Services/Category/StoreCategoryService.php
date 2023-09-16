<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;


class StoreCategoryService
{
    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }

    public function handle($payload): Category
    {
        return  DB::transaction(function () use($payload){
            $model=$this->repository->store($payload);
            return $model;

        }) ;


    }


}
