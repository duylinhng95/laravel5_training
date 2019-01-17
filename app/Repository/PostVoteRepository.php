<?php

namespace App\Repository;

interface PostVoteRepository
{
    public function votePost($postId, $userId);
}
