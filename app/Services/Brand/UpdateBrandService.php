<?php

namespace App\Services\Brand;

use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;

use Illuminate\Support\Facades\DB;


class UpdateBrandService
{

    public function __construct(public  BrandRepositoryInterface $repository,
    private MediaUploader $mediaUploader)
    {

    }

    public function handle($eloquent,array $payload):Brand
    {
        return DB::transaction(function () use ($eloquent,$payload){
            $model=$this->repository->update($eloquent,$payload);

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
