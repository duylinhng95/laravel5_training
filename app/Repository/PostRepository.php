<?php

namespace App\Repository;

interface PostRepository
{
    public function generateTagFromString($input);

    public function paginateWithTrashed($request, $num);
}
