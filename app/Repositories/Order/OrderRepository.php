<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository extends BaseRepository implements  OrderRepositoryInterface{
    public function __construct(Order $model)
    {
          parent::__construct($model);
    }
    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with('user');
    }
}
