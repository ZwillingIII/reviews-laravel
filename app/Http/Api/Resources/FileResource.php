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
            'path' => storage_path('app/' . $this->disk . '/' . $this->path) . '/' . $this->name
        ];
    }
}
