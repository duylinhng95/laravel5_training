<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categorySerivce;

    public function __construct()
    {
        $this->categorySerivce = app(CategoryService::class);
    }

    public function index()
    {
        $categories = $this->categorySerivce->all();
        return view('Category.index', compact('categories'));
    }
}
