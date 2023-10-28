<?php

namespace App\Repositories\Comment;

use App\Repositories\BaseReposirotyInterface;

interface CommentRepositoryInterface  extends BaseReposirotyInterface
{
    public function toggle($model);

}
