<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ROLE = ['admin' => 1, 'user' => 0];
    const STATUS = ['not verify' => 0, 'verify' => 1, 'block' => 2];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role',
        'rating',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rocket()
    {
        return $this->hasOne(RocketProfile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function followings()
    {
        return $this->hasMany(Follow::class, 'follower_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }
}
