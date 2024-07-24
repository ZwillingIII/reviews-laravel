<?php

namespace App\Http\Api\Requests;

use App\Http\Api\Requests\ApiRequest;

class PostsGetRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'page' => 'int',
            'count' => 'int',
            'sort' => 'string|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'page' => 'Страница',
            'count' => 'Кол-во постов',
            'sort' => 'Поле сортировки'
        ];
    }
}
