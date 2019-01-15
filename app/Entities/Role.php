<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }
}
