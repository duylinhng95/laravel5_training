<?php

namespace App\Services;

use App\Repository\FollowRepository;
use Auth;

class FollowService
{
    protected $followRepository;

    public function __construct()
    {
        $this->followRepository = app(FollowRepository::class);
    }

    public function followUser($id)
    {
        $userId = Auth::user()->id;
        return $this->followRepository->follow($id, $userId);
    }

    public function unfollowUser($id)
    {
        $userId = Auth::user()->id;
        return $this->followRepository->unfollow($id, $userId);
    }
}
