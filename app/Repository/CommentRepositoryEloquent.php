<?php

namespace App\Repository;

use App\Entities\Comment;

class CommentRepositoryEloquent extends BaseRepositoryEloquent implements CommentRepository
{
    public function model()
    {
        return Comment::class;
    }
}
