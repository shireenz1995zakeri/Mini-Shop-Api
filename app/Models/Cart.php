<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory,HasUuid,HasUser;
    protected $fillable= [
        'uuid', 'user_id', 'product_id', 'qyt',
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);

    }


}
