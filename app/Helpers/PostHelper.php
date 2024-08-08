<?php

namespace App\Helpers;

class PostHelper
{
    // TODO: Тестовый pipeline
    public function handle($query, $next)
    {
        $query->merge([
            'title' => 'А вот и нет',
            'text' => 'Нормальный текст запили'
        ]);

        return $next($query);
    }
}
