@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="col-md-8 col-xs-12 col-sm-12">
        <div class="main-content">
            <article>
                <h2 class="post-title text-black">{{$post->title}}</h2>
                @foreach($post->tags as $tag)
                <a href="{{url('/?tags='.$tag->name)}}" class="btn btn-default btn-sm btn-tags " type="submit">{{$tag->name}}</a>
                @endforeach
                <div class="post-meta">
                    <span><i class="fa fa-eye post-meta-icon"></i> {{$post->view}} </span>
                    <span><i class="fa fa-comments post-meta-icon"></i> {{$post->count_comments}} </span>
                    <span><i class="fa fa-calendar-check-o post-meta-icon"></i> {{formatDate($post->created_at)}} </span>
                    <span><i class="fa fa-thumbs-up post-meta-icon"></i> <span id="voteNum">{{count($post->votes)}}</span> </span>
                </div>
                <div class="post-content">
                    {!! $post->content !!}
                </div>
                @if(Auth::check())
                    <button type="button" class="btn btn-success" id="btnVotePost" data-post-id="{{$post->slug}}"
                            @if(Auth::id() == $post->user->id)  disabled @endif>
                        Vote <i class="fa fa-thumbs-o-up"></i>
                    </button>
                @endif
            </article>
            <div class="author">
                <div class="author-img">
                    <img class="img-responsive img-circle" src="{{asset('images/avatar.png')}}" alt="author"/>
                </div>
                <div class="author-post">
                    <h4>{{$post->user->name}}</h4>
                    @if(Auth::check())
                        @if(Auth::id() != $post->user->id)
                            <button class="btn btn-primary btn-follow @if($followed === 1) d-none @endif" data-user-id="{{$post->user->id}}">
                                Follow
                            </button>
                            <button class="btn btn-danger btn-unfollow @if($followed === 0) d-none @endif" data-user-id="{{$post->user->id}}">
                                Unfollow
                            </button>
                        @endif
                    @endif
                </div>
            </div>
            <div class="comment-post">
                <h3><span id="commentNum">{{$post->count_comments}}</span> comments</h3>
                <div class="comment comment-list">
                    @foreach($post->comments as $comment)
                    <div class="author-img">
                        <img class="img-responsive img-circle" src="{{asset('images/avatar.png')}}" alt="author"/>
                    </div>
                    <div class="author-post like-section">
                        <h4>{{$comment->user->name or 'User'}}</h4>
                        <div class="post-meta comment">
                            <span><i class="fa fa-calendar-check-o post-meta-icon"></i> {{formatDate($comment->created_at)}}</span>
                        </div>
                        <p>{{$comment->content}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-body">
                @if(Auth::check())
                <h3>leave a reply</h3>
                    <input type="hidden" name="token" value="{{csrf_token()}}" id="csrf_token">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Message*</label>
                        <div class="text-danger" id="error_message"></div>
                        <input type="text" class="form-control" id="commentContent" name="content">
                    </div>
                    <button type="button" class="btn btn-success form-btn"
                            id="btnComment"> Submit
                        <input type="hidden" name="postId" id="postId" value="{{$post->slug}}">
                    </button>
                @endif
            </div>
        </div><!-- main-content -->
    </div>
@endsection
@push('right-sidebar')
    @include('Post.partial.right-sidebar')
@endpush
<script src="{{mix('js/comment.js')}}"></script>
