<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RocketProfile extends Model
{
    public $timestamps = false;
    protected $table = "rocket_profiles";
    protected $fillable = [
        'auth_token',
        'owner_id',
        'username',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App/Entities/User');
    }
}
