<?php

namespace App\Services\User;

use App\Models\Blog;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Lorisleiva\Actions\Concerns\AsAction;


class UpdateUserService
{
    use AsAction;

    private $mediauploader;
    public function __construct(public  UserRepositoryInterface $repository,
                                private  MediaUploader $mediaUploader)
    {

    }

    public function handle($eloquent, array $payload): User
    {
        $this->repository->update($eloquent, $payload);
        if (request()->hasFile('image')) {
            $res = $this->mediaUploader->upload('images/user');
            $eloquent->medias()->updateOrCreate([
                'url' => $res['url'],
                'extension'=>$res['extension'],
                'size'=>$res['size'],
            ]);
        }
        return $eloquent;
    }
}
