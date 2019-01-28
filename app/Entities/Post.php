<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = [
        'count_comments',
        'encode_content',
        'count_votes'
    ];

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'tags'];

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
        return $this->orderBy('view', 'desc')->limit($num)->get();
    }

    public function getLatestPost($num)
    {
        return $this->orderBy('created_at', 'desc')->limit($num)->get();
    }

    public function getCountCommentsAttribute()
    {
        return count($this->comments);
    }

    public function getCountVotesAttribute()
    {
        return count($this->votes);
    }

    public function getEncodeContentAttribute()
    {
        return str_limit(strip_tags($this->content), $limit = 60, $end = '...');
    }
}
