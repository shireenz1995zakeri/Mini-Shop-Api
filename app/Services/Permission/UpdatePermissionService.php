<?php

namespace App\Services\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePermissionService
{
    use AsAction;
    public function __construct(public  PermissionRepositoryInterface $repository)
    {

    }

    public function handle($eloquent,$payload)
    {
        $model=$this->repository->update($eloquent, $payload);
        return $eloquent;
    }
}
