<?php

namespace App\Traits;

trait FormatTrait
{
    public function formatDate($date)
    {
        return date('d-m-Y', strtotime($date));
    }
}
