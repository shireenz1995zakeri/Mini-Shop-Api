<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBrandService
{
    use AsAction;
    public function __construct(public  BrandRepositoryInterface $repository)
    {

    }
    public function handle($eloquent)
    {
        return $this->repository->delete($eloquent);

    }
}
