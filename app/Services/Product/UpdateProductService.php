<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductService
{
    use AsAction;
    private $mediauploader;
    public function __construct(public ProductRepositoryInterface $repository,
                                private  MediaUploader $mediaUploader)
    {
    }

    public function handle($eloquent,$payload):Product
    {
        return DB::transaction(function () use($eloquent,$payload){
            $model=$this->repository->update($eloquent,$payload);
            TranslationService::translate($model,$payload['translation']);
            if(request()->hasFile('image')){
                $res=$this->mediaUploader->upload('images/product');
                $eloquent->medias()->updateOrCreate([
                    'url'=>$res['url'],
                    'extension'=>$res['extension'],
                    'size'=>$res['size'],
                ]);
            }
           return $eloquent;

        });
    }
}
