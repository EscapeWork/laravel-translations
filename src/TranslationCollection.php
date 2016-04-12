<?php

namespace EscapeWork\Translations;

use Illuminate\Database\Eloquent\Collection;

class TranslationCollection extends Collection
{

    public function _get($field, $locale = null)
    {
        $locale = $locale ?: config('app.locale');

        foreach ($this->items as $item) {
            if ($item->locale == $locale) {
                if ($item->{$field}) {
                    return $item->{$field};
                }

                $data = unserialize($item->data);

                return isset($data[$field]) ? $data[$field] : null;
            }
        }
    }
}
