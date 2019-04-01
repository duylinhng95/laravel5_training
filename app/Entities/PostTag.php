<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public $timestamps = false;

    public $table = 'post_tags';

    protected $fillable = ['name', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
