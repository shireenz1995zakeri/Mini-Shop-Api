<?php

namespace App\Repositories\Role;

use App\Repositories\BaseReposirotyInterface;

interface RoleRepositoryInterface  extends BaseReposirotyInterface
{
    public function addPermission($id, $permission);
    public function syncPermission($id, $permissions);



}
