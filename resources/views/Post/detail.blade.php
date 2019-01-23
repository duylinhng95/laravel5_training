@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 padding-20">
            <div class="row">
                <!-- ARTICLE  -->
                <div class="card post">
                    <div class="article-heading margin-bottom-5">
                        <i class="fa fa-pencil-square-o"></i> {{$post->title}}
                    </div>
                    <div class="article-info">
                        <div class="art-date">
                            <i class="fa fa-calendar-o"></i> {{formatDate($post->created_at)}}
                        </div>
                        <div class="art-category">
                            <i class="fa fa-folder"></i> {{$post->category->name}}
                        </div>
                        <div class="art-comments">
                            <i class="fa fa-comments-o"></i> {{count($post->comments)}}
                        </div>
                    </div>
                    <div class="article-content">
                        {!! $post->content !!}
                    </div>
                    <div class="article-content">
                        <div class="article-tags">
                            <b>Tags:</b>
                            @foreach($post->tags as $tag)
                            <a href="{{url('/post?keyword='.$tag->name)}}" class="btn btn-default btn-o btn-sm">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <hr class="style-three">
                    <div class="article-feedback">
                        <h2>
                            <small>Number of votes: <span id="voteNum">{{count($post->votes)}}</span></small>
                        </h2>
                        <button type="button" onclick="votePost({{$post->id}})" class="btn btn-success"
                                @if(Auth::user()->id == $post->user->id) disabled @endif>Vote <i
                                    class="fa fa-thumbs-o-up"></i>
                        </button>

                    </div>
                </div>
                <!-- END ARTICLE -->
                {{--Author--}}
                <div class="card post">
                    <div class="article-heading">
                        <i class="fa fa-user"></i> Author:  {{$post->user->name}}
                        @if(Auth::user()->id != $post->user->id)
                            @if($followed == 0)
                                <a href="{{route('user.follow',['id' => $post->user->id])}}" class="btn btn-primary">Follow</a>
                            @else
                                <a href="{{route('user.unfollow',['id' => $post->user->id])}}" class="btn btn-danger">Unfollow</a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- COMMENTS  -->
                <div class="card post">
                    <div class="article-heading">
                        <i class="fa fa-comments-o"></i> Comments (<span id="commentNum">{{$post->count_comments}}</span>)
                    </div>
                    <div class="comment-list">
                        @foreach($post->comments as $comment)
                        <!-- COMMENT  -->
                            <div class="article-content">
                                <div class="article-comment-top">
                                    <div class="comments-user">
                                        <div class="user-name">{{$comment->user->name}}</div>
                                        <div class="comment-post-date">Posted On
                                            <span class="italics">{{$comment->created_at}}</span>
                                        </div>
                                    </div>
                                    <div class="comments-content">
                                        {{$comment->content}}
                                    </div>
                                </div>
                            </div>
                            <!-- END COMMENT  -->
                        @endforeach
                    </div>
                    <hr class="style-three">
                    <!-- LEAVE A REPLY SECTION -->
                    <div class="panel-transparent">
                        <div class="article-heading">
                            <i class="fa fa-comment-o"></i> Leave a Reply
                        </div>
                        <form id="comment" class="comment-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="commentContent" name="content">
                            </div>
                            <div class="form-group float-right">
                                <button type="button" class="btn btn-wide btn-primary" onclick="addComment({{$post->id}})"
                                        id="btnComment">Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- END LEAVE A REPLY SECTION -->
                </div>
                <!-- END COMMENTS -->
            </div>
        </div>
        @include('Post.sidebar')
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
