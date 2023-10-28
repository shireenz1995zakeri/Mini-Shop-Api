<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductService
{
    use AsAction;

    public function __construct(public ProductRepositoryInterface $repository,
                                private MediaUploader             $mediaUploader)
    {

    }

    public function handle($payload): Product
    {

        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            TranslationService::translate($model,$payload['translation']);
            if (request()->hasFile('image')) {
                $res = $this->mediaUploader->upload('images/products');
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
