@extends('Post.layout')
@section('title')
    Edit {{$post->title}} Post
@endsection
@section('content')
    <div class="card-header">
        <h2><i class="fa fa-pen"></i> Edit {{$post->title}} Post</h2>
    </div>
    <form action="{{url('post/' . $post->id)}}" method="post">
        <div class="card-body">
            @method('PUT')
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="{{$post->title}}" value="{{$post->title}}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="{{$post->title}}" value="{{$post->title}}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Content</label>
                <textarea name="content" id="" cols="30" rows="10"
                          placeholder="{{$post->title}}" class="form-control">{{$post->title}}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
            <a href="{{url('/post')}}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
