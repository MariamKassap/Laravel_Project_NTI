<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
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
        return $this->hasMany(Application::class, 'employee_id');
    }
    //jobs 
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id');
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
}
