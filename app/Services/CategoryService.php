<?php

namespace App\Services;

use App\Repository\CategoryRepositoryEloquent;

class CategoryService
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepositoryEloquent::class);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function create($input)
    {
        return $this->categoryRepository->create($input);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update($id, $input)
    {
        return $this->categoryRepository->update($id, $input);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
