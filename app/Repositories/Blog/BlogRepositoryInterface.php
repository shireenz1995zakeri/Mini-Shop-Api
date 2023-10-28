<?php
namespace App\Repositories\Blog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use mysql_xdevapi\Collection;

interface BlogRepositoryInterface extends \App\Repositories\BaseReposirotyInterface
{
    /**
     * @param Carbon $date
     * @return Collection
     */
    public function search(array $payload = []): Builder;
    public function toggle($model);

    public function theMostVisitedBlogs();

    public function theMostCommentBlogs();
    public function popularBlog($model);
    public function getOldBlogsByDate(Carbon $date);
    public function getNewBlogsByDate(Carbon $date);

    public function getBlogsByDate($date);

}


