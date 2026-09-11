<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'post_id',
        'media_type',
        'media_path',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}