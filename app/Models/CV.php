<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CV extends Model
{
    use HasFactory;

    protected $table = 'cvs';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function application(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
