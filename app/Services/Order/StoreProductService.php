<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
    public function __construct(public OrderRepositoryInterface $repository)
    {

    }

    public function handle($payload)
    {
        return DB::transaction(function () use($payload){
          $model=$this->repository->store($payload);
            return $model;
        });

    }
}
