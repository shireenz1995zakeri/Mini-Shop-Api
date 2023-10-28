<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function toggle($model)
    {
        $model->block = !$model->block;
        $model->save();
        return $model;    }

    public function addRole($payload, $user)
    {

    }

    public function removeRole($userId, $role)
    {

    }
}
