<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $fillable=[
        'translatable_id',
        'translatable_type',
       'title',
        'body',
        'locale',
    ];

    public function translatable()
    {
        return $this->morphTo();

    }
}
