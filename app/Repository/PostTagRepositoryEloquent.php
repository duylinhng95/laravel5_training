<?php

namespace App\Repository;

use App\Repository\BaseRepositoryEloquent;
use App\Entities\PostTag;

class PostTagRepositoryEloquent extends BaseRepositoryEloquent
{
    public function model()
    {
        return PostTag::class;
    }

    public function createMany($array)
    {
        $postId = $array['id'];

    }
}
