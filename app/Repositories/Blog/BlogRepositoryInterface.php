<?php
namespace App\Repositories\Blog;

use Carbon\Carbon;
use mysql_xdevapi\Collection;

interface BlogRepositoryInterface extends \App\Repositories\BaseReposirotyInterface
{
    /**
     * @param Carbon $date
     * @return Collection
     */
    public function getBlogsByDate(Carbon $date);
}


