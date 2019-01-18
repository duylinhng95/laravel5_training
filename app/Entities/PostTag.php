<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public $timestamps = false;

    public $table = 'post_tags';

    protected $fillable = ['name', 'post_id'];

    protected $appends = ['popular_tags'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function getPopularTagsAttribute()
    {
        $tags = $this->selectRaw("Count('name') as count, name")->groupBy('name')->orderByDesc('count')->get();
        return $tags;
    }
}
