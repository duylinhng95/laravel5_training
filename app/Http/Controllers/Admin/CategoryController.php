<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Repository\CategoryRepository;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;

class CategoryController extends Controller
{
    use ResponseTrait;

    protected $categoryService;
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('Admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->except('_token');
        $this->categoryService->create($input);
        return $this->success('Create Category Successful');
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
        return $this->success('Retrive category successful', $category);
    }

    public function save(CategoryRequest $request)
    {
        $input = $request->except('_token', 'categoryId');
        $id    = $request->input('categoryId');
        $this->categoryService->update($id, $input);
        $category = $this->categoryRepository->find($id);
        return $this->success('Edit Category Successful', $category);
    }

    public function delete($id)
    {
        $checked = $this->categoryService->checkPosts($id);
        if (!$checked) {
            return $this->error('400', 'Category still contains Post');
        }
        $this->categoryService->delete($id);
        return $this->success('Delete Category Successful');
    }
}
