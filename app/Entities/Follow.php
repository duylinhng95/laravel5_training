<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['user_id', 'follower_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function follower()
    {
        return $this->hasOne(User::class, 'id', 'follower_id');
    }
}
