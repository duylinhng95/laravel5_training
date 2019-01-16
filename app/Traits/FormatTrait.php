<?php

namespace App\Traits;

trait FormatTrait
{
    public function getFormatCreatedAttribute()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }
}
