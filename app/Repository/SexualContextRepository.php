<?php

namespace App\Repository;

interface SexualContextRepository
{
    public function getBannedWords($keywords);

    public function createBannedWords($data);
}
