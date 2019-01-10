@extends('Post.layout')
@section('title')
    Create Post
@endsection
@section('content')
    <div class="card-header">
        <h2><i class="fa fa-plus"></i> Create Post</h2>
        <a href="{{url('/user/post')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
    </div>
    <form action="{{url('user/post/create')}}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control">
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
                <label for="tag">Tags</label>
                <input type="text" name="tags" class="form-control" data-role="tagsinput">
            </div>

            <div class="form-group">
                <label for="title">Content</label>
                <textarea name="content" class="form-control" id="texteditor"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
            <a href="{{url('/post')}}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
@push('script')
    <script src="{{mix('js/post.js')}}"></script>
@endpush

