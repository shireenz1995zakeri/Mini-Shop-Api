<?php


namespace App\Repositories\Brand;


use App\Models\Brand;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['translation']);
    }
}
