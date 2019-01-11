@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title"> Detail Post: {{$post->title}} </h2>
@endsection
@section('content')
    <div class="card-body text-white bg-dark ">
        <div class="row">
            <div class="col-md-10">
                <ul>
                    <li>Author: {{$post->user->name}}</li>
                    <li>Cateogry: {{$post->category->name}}</li>
                    <li>Tags: {{$tags}}</li>
                </ul>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-lg">Block</button>
            </div>
        </div>
        <div class="card text-black-50">
            <div class="card-header"><h4>Content</h4></div>
            <div class="card-body ">
                {{$post->content}}
            </div>
        </div>
    </div>
@endsection
