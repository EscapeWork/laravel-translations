<?php

namespace EscapeWork\Translations;

use EscapeWork\Translations\Translation;
use Illuminate\Database\Eloquent\Collection;

class TranslationCollection extends Collection
{
    public function _get($field, $locale = null)
    {
        $locale = $locale ?: config('app.locale');

        return $this->first(function ($i, $translation) use ($locale) {
            return $translation->locale == $locale;
        }, new Translation)->getField($field);
    }
}
