<?php

namespace App\Repository;

interface PostRepository
{
    public function generateTagFromString($input);

    public function search($keyword);
}
