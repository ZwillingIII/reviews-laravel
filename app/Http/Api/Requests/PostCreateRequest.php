<?php

namespace App\Http\Api\Requests;

class PostCreateRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2550',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'алЕ, ГДЕ НАЗВАНИЕ?',
            'title.max' => 'toomuch'
        ];
    }
}
