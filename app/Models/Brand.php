<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory,HasUuid,HasMedia,HasTranslationAuto;

    protected $fillable = [
         'uuid',
        //'title'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
