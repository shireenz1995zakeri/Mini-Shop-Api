<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
//    public function query(array $payload = []):Builder
//    {
//        return QueryBuilder::for(Permission::class)
//            ->defaultSort('-id')
//            ->allowedSorts('id')
//            ->allowedFields(['id'])
//            ->allowedFilters([
//                AllowedFilter::custom('search', new FuzzyFilter(['name'])),
//            ]);
//    }
}
