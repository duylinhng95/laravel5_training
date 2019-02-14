<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('Category.index', compact('categories'));
    }

    public function show($id)
    {
        $posts = $this->categoryRepository->findPostByCategory($id);
        return view('Category.show', compact('$posts'));
    }
}
