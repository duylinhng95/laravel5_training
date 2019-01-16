<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatTrait;

class Post extends Model
{
    use FormatTrait;

    protected $appends = [
        'popular_post',
        'latest_post',
        'count_comments',
        'format_created',
        'encode_content'
    ];

    protected $fillable = ['title', 'content', 'user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    public function getPopularPost($num)
    {
        return $this->orderBy('view', 'des')->limit($num)->get();
    }

    public function getLatestPost($num)
    {
        return $this->orderBy('created_at', 'des')->limit($num)->get();
    }

    public function getCountCommentsAttribute()
    {
        return count($this->comments);
    }

    public function getEncodeContentAttribute()
    {
        return str_limit(strip_tags($this->content), $limit = 60, $end = '...');
    }
}
