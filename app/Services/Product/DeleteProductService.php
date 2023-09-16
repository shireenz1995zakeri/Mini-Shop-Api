<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;

class DeleteProductService
{
    public function __construct(public  ProductRepositoryInterface $repository)
    {

    }

    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
