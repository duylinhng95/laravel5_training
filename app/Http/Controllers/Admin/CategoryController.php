<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;

class CategoryController extends Controller
{
    use ResponseTrait;

    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }

    public function index()
    {
        $categories = $this->categoryService->all();
        return view('Admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $this->categoryService->create($input);
        return $this->responseCode('200', 'Create Category Successful');
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
        return $this->responseObject($category);
    }

    public function save(Request $request)
    {
        $input = $request->except('_token', 'categoryId');
        $id = $request->input('categoryId');
        $this->categoryService->update($id, $input);
        return $this->responseCode('200', 'Edit Category Successful');
    }

    public function delete($id)
    {
        $this->categoryService->delete($id);
        return $this->responseCode('200', 'Delete Category Successful');
    }
}
