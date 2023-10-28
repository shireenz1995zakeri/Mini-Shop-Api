<?php

namespace App\Services\Permission;

use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;


class DeletePermissionService
{
    use AsAction;
    public function __construct(public  PermissionRepositoryInterface $repository)
    {

    }

    public function handle($eloquent)
    {
        return $eloquent->delete();
    }

}
