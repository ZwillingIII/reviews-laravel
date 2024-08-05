<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class File extends Model
{
    use HasFactory;

    protected $hidden = [
        'original'
    ];

    public function getUrlAttribute()
    {
        return config('app.url') . '/' . $this->disk . '/' . $this->path . '/' . $this->name;
    }
}
