<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,HasUuid;
    protected $fillable=[
        'uuid',
        'title',
        'parent_id',
        'published',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);

    }




}
