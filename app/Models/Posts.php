<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
