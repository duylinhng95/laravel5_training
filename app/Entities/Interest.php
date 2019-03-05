<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = ['tags', 'categories', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
