@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a href="{{url('/user/post')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
    </div>
    <div class="card-body">
        <div class="row">
            <ul>
                <li>Author: {{$post->user->name}}</li>
                <li>Tags: <input type="text" value="{{$tags}}" data-role="tagsinput" disabled></li>
                <li>Created Date: {{$post->created_at}}</li>
                <li>Content:</li>
                {{$post->content}}
            </ul>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <h3>Comment</h3>

        </div>
        <div class="comment-list">
            @foreach($comments as $comment)
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading user_name">{{$comment->user->name}}</h4>
                        {{$comment->content}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card">
            <div class="card-header"><h4>Your comment</h4></div>
            <div class="card-body">
                <div class="col-md-12">
                    <form id="comment">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="commentContent" name="content">
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-info" onclick="addComment({{$post->id}})" id="btnComment">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var addCommentURI = "{{url('/post/comment')}}/";

	    $(document).on('keypress',function(e) {
		    if(e.which == 13) {
			    $('#btnComment').click();
		    }
	    });
    </script>
    <script src="{{mix('js/comment.js')}}"></script>
@endpush
