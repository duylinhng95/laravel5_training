<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RocketProfile extends Model
{
    protected $table = "rocket_profiles";

    protected $fillable = [
        'auth_token', 'owner_id', 'username', 'user_id'
    ];

    public $timestamps = false;

    public function user()
    {
        $this->belongsTo('App/Entities/User');
    }
}
