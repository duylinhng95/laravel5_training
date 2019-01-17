<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ROLE   = ['ADMIN' => 2, 'USER' => 1];
    const STATUS = ['NOT_VERIFY' => 0, 'VERIFY' => 1, 'BLOCK' => 2];

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

    protected $appends = [
        'count_follow',
        'count_post',
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

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function getCountPostAttribute()
    {
        return count($this->posts);
    }

    public function getCountFollowAttribute()
    {
        return count($this->followings);
    }

    public function checkFollow($id)
    {
        return $this->follows->contains('follower_id', $id);
    }

    public function checkRole($roleId)
    {
        return $this->userRoles->contains('role_id', $roleId);
    }
}
