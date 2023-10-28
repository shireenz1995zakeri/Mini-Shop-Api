<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class StoreCategoryService
{
    use AsAction;

    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }

    public function handle($payload): Category
    {
        return  DB::transaction(function () use($payload){
            $model=$this->repository->store($payload);
            TranslationService::translate($model,$payload['translation']);
            return $model;

        }) ;


    }


}
