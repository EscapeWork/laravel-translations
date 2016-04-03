<?php

namespace EscapeWork\Translations;

use Illuminate\Database\Eloquent\Collection;

class TranslationCollection extends Collection
{

    public function _get($field, $language)
    {
        $language = $language ?: config('app.locale');

        foreach ($this->items as $item) {
            if ($item->language == $language) {
                if ($item->{$field}) {
                    return $item->{$field};
                }

                $data = unserialize($item->data);

                return isset($data[$field]) ? $data[$field] : null;
            }
        }
    }
}
