@extends('Post.layout')
@section('title')
    Edit {{$post->title}} Post
@endsection
@section('content')
    @include('Post.User.error')
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2><i class="fa fa-pen"></i> Edit {{$post->title}} Post</h2>
                <a href="{{route('user.post.index')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
            </div>
            <form action="{{route('user.post.update', ['slug' => $post->slug])}}" method="post">
                <div class="panel-body">
                    @method('PUT')
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="{{$post->title}}" value="{{$post->title}}"
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
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$post->category->id == $category->id ? 'selected="selected"' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tag">Tags</label>
                        <input type="text" name="tags" class="form-control" data-role="tagsinput" value="{{$tags}}">
                        @if($errors->has('tags'))
                            <div class="text-danger">
                                <span>* </span>{{$errors->first('tags')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title">Content</label>
                        <textarea name="content" class="form-control" id="texteditor">{{$post->content}}</textarea>
                        @if($errors->has('content'))
                            <div class="text-danger">
                                <span>* </span>{{$errors->first('content')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                    <a href="{{route('user.post.index')}}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
