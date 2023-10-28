<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUuid;
use App\Traits\HasView;
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
    use HasFactory, HasComment, HasMedia, HasLike, HasUser,HasView ,HasUuid, SoftDeletes,HasTranslationAuto;


    protected $fillable = [
        'uuid',
       // 'title',
       // 'body',
        'category_id',
        'user_id',
        'published',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
//
    public function translation()
    {
        return $this->morphMany(Translation::class, 'translatable')->
        where('locale', app()->getLocale());
    }



}
