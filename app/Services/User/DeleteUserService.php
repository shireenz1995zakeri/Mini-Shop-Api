<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUserService
{
    use AsAction;

    public function __construct(public  UserRepositoryInterface $repository)
    {

    }

    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
