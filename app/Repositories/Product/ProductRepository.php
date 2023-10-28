<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['category','brand','translation']);
    }

    public function theMostVisitedProducts()
    {
        $data = $this->query()->withCount('views')->orderByDesc('views_count')->limit('10')->get();
        return $data;
    }


    public function expensive()
    {
        $data=$this->query()->orderByDesc('price')->limit('10')->get();
        return $data;
    }


    public function theMostCommentProducts()
    {
        $data = $this->query()->withCount('comments')->orderByDesc('comments_count')->limit('10')->get();
        return $data;
    }

    public function toggle($model)
    {
        $model->published = !$model->published;
        $model->save();
        return $model;
    }

    public function popularProducts($model)
    {
        $data = get_class($model)::withCount('likes')->orderByDesc('likes_count')->get();
        return $data;
    }

    public function getOldProductsByDate(Carbon $data)
    {
        $data = $this->query()->whereDate('created_at', '<', $data)->get();
        return $data;
    }

    public function getNewProductsByDate(Carbon $data)
    {
        $data = $this->query()->whereDate('created_at', '>', Carbon::now()->subDays($passDay))->get();
        return $data;
    }

    public function getProductsByDate($date)
    {
        $data = $this->query()->whereDate('created_at', $date)->get();
    }

    public function NumberOfAproductPurchasedByAUser($user)
    {

        $query = Product::query()->whereHas('order_items', function ($query) use ($user) {
            $query->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        })->withCount(['order_items' => function ($query) use ($user) {
            $query->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }])->
        withCount([
            'order_items As order_items_sum' => function ($query) use ($user) {
                $query->select(DB::raw("SUM(qyt) as paidsum"), function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }
        ])->orderBy('order_items_sum', 'desc')
            ->limit(4)->get();
        return $query;
    }

    public function BestSellingProducts()
    {
        $query = Product::query()->withCount([
            'order_items As order_items_sum' => function ($query) {
                $query->select(DB::raw("SUM(qyt*price) as paidsum"));
            }
        ])->orderBy('order_items_sum', 'desc')->limit(5)->get();
        return $query;
    }

    public function ProductBuyUser($user)
    {
        $query = Product::whereHas('order_items', function ($query) use ($user) {
            $query->whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->get();
        return $query;
    }
}
