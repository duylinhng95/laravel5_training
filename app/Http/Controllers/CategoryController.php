<?php

namespace App\Http\Controllers;

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
        return view('Category.index', compact('categories'));
    }
}
