<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProductService
{
    use AsAction;

    public function __construct(public  ProductRepositoryInterface $repository)
    {

    }

    public function handle($eloquent):bool
    {
        return $this->repository->delete($eloquent);
    }

}
