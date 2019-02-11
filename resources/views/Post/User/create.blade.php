@extends('Post.layout')
@section('title')
    Create Post
@endsection
@push('header')
    @include('Post.partial.header')
@endpush
@section('content')
    @include('Post.User.error')
    <div class="card-header">
        <h2><i class="fa fa-plus"></i> Create Post</h2>
        <a href="{{route('user.post.index')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
    </div>
    <form action="{{route('user.post.store')}}" method="POST" enctype="multipart/form-data" novalidate>
        <div class="card-body">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control">
                @if($errors->has('title'))
                    <div class="text-danger">
                        <span>* </span>{{$errors->first('title')}}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" name="tags" class="form-control" id="tagsinput"
                       data-role="tagsinput">
                @if($errors->has('tags'))
                    <div class="text-danger">
                        <span>* </span>{{$errors->first('tags')}}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="title">Content</label>
                <textarea name="content" class="form-control"
                          id="texteditor"></textarea>
                @if($errors->has('content'))
                    <div class="text-danger">
                        <span>* </span>{{$errors->first('content')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
            <a href="{{route('user.post.index')}}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection

