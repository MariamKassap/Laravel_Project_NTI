<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable automatic timestamps

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
