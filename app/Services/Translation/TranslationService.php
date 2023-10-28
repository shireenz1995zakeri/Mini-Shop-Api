<?php

namespace App\Services\Translation;

use App\Traits\HasTranslation;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    use HasTranslation;

    public static function translate($model, array $data): void
    {

        foreach ($data as $locale => $value) {

            if (isset($value['title']) && $value['title'] != '') {

                $model->translations()->updateOrCreate([
                    'translatable_id' => $model->id,
                    'translatable_type' => $model::class,
                    'locale' => $locale,
//                    'title' => $value['title'],
//                    'body' => $value['body'],

                ], $value);

//                foreach ($value as $key => $val) {
//                    Cache::forget(self::generateCacheKey($model::class, $model->id,));
//
//                }

            }


        }
    }

    public static function get($model, string $key): mixed
    {
//        dd(($model->translation)->$key);
//        return \cache()->rememberForever(self::generateCacheKey($model::class, $model->id, $key, app()->getLocale()),
//            function () use ($model, $key) {
                return optional($model->translation)->$key;
//            });
    }

    private static function generateCacheKey(string $type, int $id, string $key, string $local): string
    {
        return 'translated:' . class_basename($type) . ':' . $id . ':' . $key . ':' . $local;
    }
}
