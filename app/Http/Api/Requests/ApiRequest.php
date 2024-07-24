<?php

namespace App\Http\Api\Requests;

use App\Exceptions\ApiException;
use App\Exceptions\ValidatorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        // получаем ошибки валидации
        $errors = $validator->errors();
        // получаем все сообщения об ошибках
        $messages = array_values($errors->messages());
        // берем самое первое сообщение об ошибке
        $message = $messages[0][0];

        // если есть ошибка кидаем ValidationException
        if ($errors->count() > 0) {
            throw new ValidatorException($message, 422, ApiException::VALIDATION_ERROR, null, $errors);
        }
    }
}
