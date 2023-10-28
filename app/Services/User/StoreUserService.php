<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\MediaUploder\MediaUploader;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserService
{
    use AsAction;

    public function __construct(public  UserRepositoryInterface $repository,
                                private  MediaUploader $mediaUploader)
    {

    }

    public function handle($payload): User
    {
        return DB::transaction(function () use ($payload) {

            $model = $this->repository->store($payload);
            if (request()->hasFile('image')) {
                $res = $this->mediaUploader->upload('images/blogs');
                $model->medias()->updateOrCreate([
                    'url' => $res['url'],
                    'extension'=>$res['extension'],
                    'size'=>$res['size'],
                ]);
            }
            return $model;

        });//end of transaction

    }//end of handle

}
