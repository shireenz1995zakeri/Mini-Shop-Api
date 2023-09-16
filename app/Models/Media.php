<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory,HasUuid;
    protected $fillable=[
        'uuid',
        'mediaable_id',
        'mediaable_type',
        'url',
        'extension',
        'size',
    ];
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
}
