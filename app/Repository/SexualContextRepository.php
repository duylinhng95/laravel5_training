<?php

namespace App\Repository;

interface SexualContextRepository
{
    public function paginateBannedWords($keywords = '');

    public function getBannedWords();

    public function createBannedWords($data);
}
