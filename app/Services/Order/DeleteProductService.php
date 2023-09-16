<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;

class DeleteProductService
{

    public function __construct(public OrderRepositoryInterface $repository)
    {

    }

    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
