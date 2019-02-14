<?php

namespace App\Repository;

use App\Repository\BaseRepositoryEloquent;
use App\Entities\Category;

class CategoryRepositoryEloquent extends BaseRepositoryEloquent
{
    public function model()
    {
        return Category::class;
    }

    public function findPostByCategory($categoryId)
    {
        $category = $this->find($categoryId);
        return $category->posts;
    }
}
