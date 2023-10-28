<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUser;

    protected  $fillable= [
        'user_id', 'order_id', 'amount', 'token', 'description', 'gateway_name', 'status','trans_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
