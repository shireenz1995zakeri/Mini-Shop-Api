<?php


namespace App\Repositories\Blog;


use App\Models\Blog;
use App\Repositories\BaseRepository;

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

    public function theMostCommentBlogs()
    {
        $data = $this->query()->withCount('comments')->orderByDesc('comments_count')->limit('10')->get();
        return $data;
    }
}





