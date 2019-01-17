<?php

namespace App\Traits;

trait FormatTrait
{
    public function getFormatCreatedAttribute($model)
    {
        return date('d-m-Y', strtotime($model->created_at));
    }
}
