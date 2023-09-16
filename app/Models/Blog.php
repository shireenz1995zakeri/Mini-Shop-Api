<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasMedia;
use App\Traits\HasComment;
use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Translation\TranslationService;


class Blog extends Model
{
    use HasFactory, HasComment, HasMedia, HasLike, HasUser, HasUuid, SoftDeletes,HasTranslationAuto;


    protected $fillable = [
        'uuid',
        'title',
        'body',
        'category_id',
        'user_id',
        'published',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
//
//    public function translation()
//    {
//        return $this->morphOne(Translation::class, 'translatable')->where('locale', app()->getLocale());
//    }
//
//    private array $translatable = ['title', 'summery'];
//
//    public function getAttribute($key)
//    {
//        if (in_array($key, $this->translatable)) {
//                 return TranslationService::get($this,$key);
//        }
//        return $this->attributes[$key];
//    }
//
//    public function setAttribute($key,$value)
//    {
//        if(in_array($key,$this->translatable)){
//              return TranslationService::store($this,$key,$value);
//            }
//        $this->attributes[$key]=$value;
//
//    }
//    public function scopeEn($builder){
//        $builder->select(['*' ,'blogs.id as id'])
//            ->join('translations','blogs.id','=','translations.translatable_id')
//            ->where('translations.translatable_type',Blog::class)
//            ->where('translations.locale',app()->getLocale());
//    }


}
