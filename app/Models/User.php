<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // cv 
    public function cvs(): HasMany
    {
        return $this->hasMany(CV::class);
    }
    // application 
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id');
    }
    //jobs 
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'user_id');
    }
    //posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    //post likes
    public function postLikes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }
    //comments
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

    //filament  admin access
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }
}
