<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory,HasUuid;
    protected $fillable=[
        'metaable_id',
        'key',
        'value',
    ];
    public function metable(){
        return $this->morphTo();

    }
}
