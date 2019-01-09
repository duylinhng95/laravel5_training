<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content'];

    public function category()
    {
        $this->belongsTo("App\Entities\Category");
    }
}
