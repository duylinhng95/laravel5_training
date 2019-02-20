<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SexualContext extends Model
{
    public    $timestamps = false;
    protected $fillable   = ['context'];
}
