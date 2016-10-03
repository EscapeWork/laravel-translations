<?php

namespace EscapeWork\Translations;

class LocalesComposer
{
    public function compose($view)
    {
        $view->locales = Locale::all();
    }
}
