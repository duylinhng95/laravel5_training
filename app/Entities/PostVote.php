<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
