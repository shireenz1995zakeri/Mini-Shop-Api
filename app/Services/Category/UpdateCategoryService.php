<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class UpdateCategoryService
{
    use AsAction;

    public function __construct(public CategoryRepositoryInterface $repository)
    {

    }

    public function handle($eloquent, array $payload):Category
    {
       return DB::transaction(function () use($eloquent,$payload){
           $this->repository->update($eloquent,$payload);
           TranslationService::translate($eloquent,$payload['translation']);
           return  $eloquent;
       });
    }

}
