<?php

namespace App\Repository;

use App\Entities\PostVote;

class PostVoteRepositoryEloquent extends BaseRepositoryEloquent implements PostVoteRepository
{
    public function model()
    {
        return PostVote::class;
    }

    public function votePost($postId, $userId)
    {
        return $this->makeModel()->create([
            'post_id' => $postId,
            'user_id' => $userId
        ]);
    }
}
