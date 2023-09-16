<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;
    protected $fillable=[

        'likeable_id',
        'likeable_type',
        'user_id',
    ];
    public function likeable()
    {
        return $this->morphTo();
    }
}
