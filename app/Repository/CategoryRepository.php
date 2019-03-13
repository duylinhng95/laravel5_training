<?php

namespace App\Repository;

interface CategoryRepository
{
    public function findPostByCategory($categoryId);
}
