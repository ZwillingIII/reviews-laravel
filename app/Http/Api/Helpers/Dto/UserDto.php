<?php

namespace App\Http\Api\Helpers\Dto;

class UserDto
{
    public string $name;
    public string $phone;
    public string $token;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->token = $data['token'];
    }
}
