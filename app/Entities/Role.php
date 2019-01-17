<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public    $timestamps = false;
    protected $fillable   = ['name'];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }
}
