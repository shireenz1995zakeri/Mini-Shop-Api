<?php


namespace App\Repositories\Blog;


use App\Models\Blog;
use App\Repositories\BaseRepository;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function search(array $payload = []): Builder
    {
        return parent::query($payload)
            ->when(!empty($payload['search']),function ($q) use ($payload){
                $q->where('title','like','%'.$payload['search'].'%');
            });
    }

    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['category','translation']);
    }

    //پربازدید ترین مقاله ها
    public function theMostVisitedBlogs()
    {
        $data = $this->query()->withCount('views')->orderByDesc('views_count')->limit('10')->get();
        return $data;
    }

    public function toggle($model)
    {

        $model->published = !$model->published;
        $model->save();
        return $model;
    }
   ///\ربحث ترین مقالات
    public function theMostCommentBlogs()
    {
        $data = $this->query()->withCount('comments')->orderByDesc('comments_count')->limit('10')->get();
        return $data;
    }
////محبوب ترین مقالات بر حسب لایک
    public function popularBlog($model)
    {
        $data = get_class($model)::withCount('likes')->orderByDesc('likes_count');
        return $data;
    }
//مقاله های قدیمی را حدف کن

    public function getOldBlogsByDate(Carbon $date)
    {
        $data = $this->query()->whereDate('created_at', '<', $date)->get();
        return $data;
    }
//جدید ترین مقاله ها را نمایش بده
    public function getNewBlogsByDate(Carbon $date)
    {
        $data = $this->query()->whereDate('created_at', '>', $date)->get();
        return $data;
    }
//تاریخ را بگیر و مقاله های ایجاد شده در آن ماه را نمایش بده
    public function getBlogsByDate($date)
    {
        $data = $this->query()->orderByDesc('created_at')->whereDate('created_at',  $date)->get();
        return $data;
    }

}





