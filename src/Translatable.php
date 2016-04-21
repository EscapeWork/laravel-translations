<?php

namespace EscapeWork\Translations;

use EscapeWork\Translations\Translation;

trait Translatable
{

    public static function bootTranslatable()
    {
        static::deleted(function($model) {
            Translation::where('model', '=', get_class($model))
                  ->where('model_id', '=', $model->id)
                  ->delete();
        });
    }

    public function scopeActiveLanguage($query)
    {
        return $query->where('translations.language', '=', config('app.locale'));
    }

    public function translations()
    {
        return $this->morphMany('EscapeWork\Translations\Translation', 'translations', 'model', 'model_id');
    }

    public function scopeJoinTranslations($query)
    {
        return $query->join('translations', 'translations.model_id', '=', $this->table . '.id')
                     ->where('translations.model', '=', static::class);
    }

    public function storeTranslation($data, $locale = null, $options = [])
    {
        if (! $locale) {
            $locale = config('app.locale');
        }

        $translation = new Translation;
        return $translation->store($this, $locale, $data, $options);
    }

    public function deleteTranslations()
    {
        return (new Translation)->deleteFromModel($this);
    }
}
