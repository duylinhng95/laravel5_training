@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a @if(Auth::user()->id == $post->user->id)
           href="{{url('/user/post')}}"
           @else
           href="{{url('/post')}}"
           @endif
           class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
    </div>
    <div class="card-body">
        <div class="row">
            <ul>
                <li>Author: {{$post->user->name}}
                    @if($followed == 0)
                        <a href="{{url('user/follow/'.$post->user->id)}}" class="btn btn-primary">Follow</a>
                    @else
                        <a href="{{url('user/unfollow/'.$post->user->id)}}" class="btn btn-danger">Unfollow</a>
                    @endif
                </li>
                <li>Tags: <input type="text" value="{{$tags}}" data-role="tagsinput" disabled></li>
                <li>Created Date: {{$post->created_at}}</li>
                <li>Content:</li>
                {{$post->content}}
            </ul>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                <h3>Comment</h3>
            </div>
            <div class="col-md-6">
                <h4>Votes: <span id="voteNum">{{count($post->votes)}}</span></h4>
                <button type="button" onclick="votePost({{$post->id}})" class="btn btn-success"
                        @if(Auth::user()->id == $post->user->id) disabled @endif>Vote <i
                            class="fa fa-plus"></i>
                </button>
            </div>
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
                            <button type="button" class="btn btn-info" onclick="addComment({{$post->id}})"
                                    id="btnComment">Add
                            </button>
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
			var votePostURI = "{{url('/post/vote')}}/";

			$(document).on('keypress', function (e) {
				if (e.which == 13) {
					$('#btnComment').click();
				}
			});
    </script>
    <script src="{{mix('js/comment.js')}}"></script>
@endpush
