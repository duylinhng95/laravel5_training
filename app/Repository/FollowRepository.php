<?php

namespace App\Repository;

interface FollowRepository
{
    public function follow($followId, $userId);
}
