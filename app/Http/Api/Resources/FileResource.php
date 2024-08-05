<?php

namespace App\Http\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'size' => $this->size,
            'type' => $this->type,
            'path' => $this->url
        ];
    }
}
