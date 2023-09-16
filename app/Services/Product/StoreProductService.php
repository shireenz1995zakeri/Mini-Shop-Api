<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
    public function __construct(public ProductRepositoryInterface $repository,
                                private MediaUploader             $mediaUploader)
    {

    }

    public function handle($payload): Product
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            if (request()->hasFile('image')) {
                $res = $this->mediaUploader->upload('images/blogs');
                $model->medias()->create([
                    'url'       => $res['url'],
                    'extension' => $res['extension'],
                    'size'      => $res['size'],
                ]);
            }
            return $model;
        });
    }

}
