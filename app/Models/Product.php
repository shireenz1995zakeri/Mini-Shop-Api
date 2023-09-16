<?php

namespace App\Models;

use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,HasComment,HasMedia,HasLike,HasUser,HasUuid,SoftDeletes;
    protected $fillable=[
        'uuid',
        'category_id',
        'brand_id',
        'inventory',
        'published',
        'title',
        'body',
        'price',
    ];



    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand():BelongsTo
    {
         return $this->belongsTo(Brand::class) ;
    }

}
