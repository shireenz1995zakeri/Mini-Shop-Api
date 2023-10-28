<?php

namespace App\Services\Brand;

use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use App\Services\Translation\TranslationService;
use App\Traits\HasMedia;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class StoreBrandService
{
    use AsAction;
    use HasMedia;
    public function __construct(public BrandRepositoryInterface $repository,
    private MediaUploader $mediaUploader)
    {

    }

    public function handle($payload ):Brand
    {
        return DB::transaction(function ()use($payload)
        {
            $model=$this->repository->store($payload);
            TranslationService::translate($model,$payload['translation']);

            if(request()->hasFile('image')){
                $res=$this->mediaUploader->upload('images/brand');
                 $model->medias()->create([
                     'url' => $res['url'],
                     'extension'=>$res['extension'],
                     'size'=>$res['size'],
                 ]);
               // dd($model->load('medias'));

            }
            return $model;
        });
    }

}
