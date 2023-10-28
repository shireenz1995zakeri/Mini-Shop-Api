<?php


namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['translation']);
    }

}
