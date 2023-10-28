<?php

namespace App\Services\Brand;

use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;

use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class UpdateBrandService
{
    use AsAction;
    public function __construct(public  BrandRepositoryInterface $repository,
    private MediaUploader $mediaUploader)
    {

    }

    public function handle($eloquent,array $payload):Brand
    {
        return DB::transaction(function () use ($eloquent,$payload){
            $model=$this->repository->update($eloquent,$payload);
            TranslationService::translate($model,$payload['translation']);
            if(request()->hasFile('image')){
                $res=$this->mediaUploader->upload('images/brand');

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
