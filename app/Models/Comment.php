<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Comment extends Model
{
    use HasFactory,HasUuid;


    protected $fillable=[
        'uuid', 'commentable_id', 'commentable_type',
        'user_id',
        'published',
        'comment',
        'parent_id',
    ];
    public function commentable():morphTo
    {
        return $this->morphTo();
    }
}
