<?php

namespace App\Http\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostLike extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'is_liked' => boolval($this->is_liked)
        ];
    }
}
