<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\PostRepositoryEloquent;
use Exception;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepositoryEloquent::class);
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return view('Post/index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
        return $post;
    }

    public function create()
    {
        return view('Post/create');
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $this->postRepository->create($input);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect('/post');
    }

    public function edit($id)
    {
        if ($post = $this->postRepository->find($id)) {
            return view('Post/edit', compact('post'));
        } else {
            throw new Exception('Post not found');
        }
    }

    public function update($id, Request $request)
    {
        $input = $request->except('_method', '_token');
        $this->postRepository->update($id, $input);

        return redirect('/post');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
    }
}
