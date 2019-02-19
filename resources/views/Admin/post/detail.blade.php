@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title"> Detail Post: {{$post->title}} </h2>
@endsection
@section('content')
    <div class="card-body text-white bg-dark ">
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li>Author: {{$post->user->name}}</li>
                    <li>Category: {{$post->category->name}}</li>
                    <li>Tags: {{$tags}}</li>
                    <li>Created date: {{$post->created_at}}</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="row m-b-10">
                    <form method="post" action="{{route('admin.post.delete', ['id' => $post->id])}}" class="w-75">
                        {!! method_field('delete') !!}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger w-100">Permanently Delete</button>
                    </form>
                </div>
                <div class="row">
                    @if($post->deleted_at != null)
                        <a href="{{route('admin.post.restore', ['id' =>$post->id])}}" class="w-75 btn btn-primary">Restore
                            post</a>
                    @elseif($post->status == 'new')
                        <a href="{{route('admin.post.publish', ['id' =>$post->id])}}" class="w-75 btn btn-success">Publish
                            post</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card text-black-50">
            <div class="card-header"><h4>Content</h4></div>
            <div class="card-body ">
                {!! $post->content !!}
            </div>
        </div>
    </div>
@endsection
