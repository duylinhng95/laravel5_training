<?php

namespace App\Repository;

interface PostRepository
{
    public function getPosts($request);

    public function generateTagFromString($input);

    public function paginateWithTrashed($request, $num);
}
