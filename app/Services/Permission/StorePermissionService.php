<?php

namespace App\Services\Permission;

use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePermissionService
{
    use AsAction;
    public function __construct(public  PermissionRepositoryInterface $repository)
    {

    }

    public function handle($payload)
    {
        return DB::transaction(function () use ($payload) {

            $model = $this->repository->store($payload);
            return $model;
        });
    }
}
