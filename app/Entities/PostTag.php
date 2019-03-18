<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @method selectRaw(string $string)
 */
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
        $tags = $this
            ->join('posts', 'posts.id', '=', 'post_tags.post_id')
            ->where('status', config('constant.post.status.available'))
            ->selectRaw("Count('name') as count, name")
            ->groupBy('name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        return $tags;
    }
}
