<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
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
        $this->categoryService->updateOrCreate($input);
        return response()->json(['code' => 200, 'message' => 'Create Category Success']);
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
        return response()->json($category);
    }

    public function save(Request $request)
    {
        $input = $request->except('_token', 'categoryId');
        $id = $request->input('categoryId');
        $this->categoryService->update($id, $input);
        return response()->json(['code' => 200, 'message' => 'Edit Category Success']);
    }

    public function delete($id)
    {
        $this->categoryService->delete($id);
        return response()->json(['code' => 200, 'message' => 'Delete Category Success']);
    }
}
