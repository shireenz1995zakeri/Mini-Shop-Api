<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteOrderService
{
    use AsAction;

    public function __construct(public OrderRepositoryInterface $repository)
    {

    }

    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
