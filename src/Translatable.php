<?php

namespace EscapeWork\Translations;

trait Translatable
{

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
}
