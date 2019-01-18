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
                    <li>Cateogry: {{$post->category->name}}</li>
                    <li>Tags: {{$tags}}</li>
                    <li>Created date: {{$post->created_at}}</li>
                </ul>
            </div>
            <div class="col-md-4">
                <form method="post" action="{{url('/admin/post/'.$post->id)}}" class="">
                    {!! method_field('delete') !!}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Permanently Delete</button>
                </form>
                @if($post->deleted_at != null)
                <a href="{{url('/admin/post/restore/'.$post->id)}}" class="btn btn-primary">Restore post</a>
                @endif
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
