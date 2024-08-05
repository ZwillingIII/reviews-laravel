<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    public function reviews() : HasMany
    {
        return $this->hasMany(Reviews::class);
    }

    public function files() : BelongsTo
    {
        return $this->belongsTo(File::class);
    }

}
