<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // CV
    public function cvs(): HasMany
    {
        return $this->hasMany(CV::class);
    }

    // Applications
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    // Jobs
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'user_id');
    }

    // Posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Post Likes
    public function postLikes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    // Comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }
}