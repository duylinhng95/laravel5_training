@extends('Post.layout')
@section('title')
    Create Post
@endsection
@section('content')
    <div class="card-header">
        <h2><i class="fa fa-plus"></i> Create Post</h2>
    </div>
    <form action="{{url('post')}}" method="post">
        <div class="card-body">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Content</label>
                <textarea name="content" id="" cols="30" rows="10"
                          class="form-control"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
            <a href="{{url('/post')}}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection

