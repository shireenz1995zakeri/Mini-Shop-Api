<?php


namespace App\Repositories\Blog;


use App\Models\Blog;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Collection;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload = []): Builder
    {
        return parent::query($payload)
            ->when(!empty($payload['search']),function ($q) use ($payload){
                $q->where('title','like','%'.$payload['search'].'%');
            });
    }


    public function getBlogsByDate(Carbon $date)
    {
        $data = $this->query()->whereDate('created_at', '<', $date)->get();
       return $data;
    }
}
