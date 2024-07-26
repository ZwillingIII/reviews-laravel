<?php

namespace App\Http\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'token' => $this->remember_token,
            'img' => new FileResource($this->files)
        ];
    }
}
