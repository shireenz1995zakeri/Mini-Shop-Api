<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['category','brand','translation']);
    }

    public function theMostVisitedProducts()
    {
        $data = $this->query()->withCount('views')->orderByDesc('views_count')->limit('10')->get();
        return $data;
    }


    public function expensive()
    {
        $data=$this->query()->orderByDesc('price')->limit('10')->get();
        return $data;
    }


    public function theMostCommentProducts()
    {
        $data = $this->query()->withCount('comments')->orderByDesc('comments_count')->limit('10')->get();
        return $data;
    }

    public function toggle($model)
    {
        $model->published = !$model->published;
        $model->save();
        return $model;
    }
}
