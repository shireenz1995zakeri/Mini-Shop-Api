<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Illuminate\Support\Facades\DB;

class UpdateProductService
{
    public function __construct(public ProductRepositoryInterface $repository,
                                private  MediaUploader $mediaUploader)
    {
    }

    public function handle($eloquent,$payload)
    {
        return DB::transaction(function () use($eloquent,$payload){
            $model=$this->repository->update($eloquent,$payload);
            if(request()->hasFile('image')){
                $res=$this->mediaUploader->upload('images/product');
                $eloquent->medias()->createOrUpdate([
                    'url'=>$res['url'],
                    'extension'=>$res['extension'],
                    'size'=>$res['size'],
                ]);
            }
           return $eloquent;

        });
    }
}
