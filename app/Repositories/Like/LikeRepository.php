<?php

namespace App\Repositories\Like;

use App\Models\Like;
use App\Repositories\BaseRepository;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function __construct(Like $model)
    {
        parent::__construct($model);
    }
}
