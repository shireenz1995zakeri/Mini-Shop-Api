<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use App\Services\Translation\TranslationService;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;


class StoreBlogService
{
    use AsAction;
    public function __construct(public  BlogRepositoryInterface $repository,
    private  MediaUploader $mediaUploader)
    {

    }


//    store data of blog
    public function handle($payload): Blog
    {
        return DB::transaction(function () use ($payload) {

            $model = $this->repository->store($payload);

            TranslationService::translate($model,$payload['translation']);
            if (request()->hasFile('image')) {
                $res = $this->mediaUploader->upload('images/blogs');
                $model->medias()->create([
                    'url' => $res['url'],
                    'extension'=>$res['extension'],
                    'size'=>$res['size'],
                ]);
            }

            return $model;

        });//end of transaction

    }//end of handle




}
