<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property int view
 */
class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = [
        'count_comments',
        'encode_content',
        'count_votes'
    ];

    public $statusName = ['Pending' => 0, 'Available' => 1,];

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'status', 'slug'];

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

    public function checkOwner($userId)
    {
        $ownerId = $this->user->id;
        return $ownerId == $userId;
    }
}
