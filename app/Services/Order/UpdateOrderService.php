<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOrderService
{
    use AsAction;

    public function __construct(public OrderRepositoryInterface $repository)
    {

    }

    public function handle($eloquent,$payload)
    {
        return   DB::transaction(function ()use ($eloquent,$payload){
            $model=$this->repository->update($eloquent);
            return $eloquent;

        });
    }

}
