<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory,HasUuid,HasUser;
    protected $fillable = [
        'uuid',
        'user_id',
        'total',
        'status',
    ];

    public function orderItems()
    {
         return $this->hasMany(OrderItem::class);
    }



}
