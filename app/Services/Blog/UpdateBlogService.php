<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use App\Services\Translation\TranslationService;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBlogService
{
    use AsAction;
    private $mediauploader;

    public function __construct(public  BlogRepositoryInterface $repository,
                                public  MediaUploader          $mediaUploader)
    {

    }

    public function handle($eloquent, array $payload): Blog
    {
        $model=$this->repository->update($eloquent, $payload);
        TranslationService::translate($model,$payload['translation']);
        if (request()->hasFile('image')) {
            $res = $this->mediauploader->upload('images/blog');
            $eloquent->medias()->updateOrCreate([
                'url' => $res['url'],
            ]);
        }
        return $eloquent;
    }



}
