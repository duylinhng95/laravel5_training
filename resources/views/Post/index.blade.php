@extends('Post.layout')
@section('content')
    @include('Post.partial.left-sidebar')
    <div class="col-lg-8 col-md-8" id="indexContent">
        <!-- POST -->
        @if($posts->isEmpty())
            <div class="text-center">
                <h4>There are no post can be found</h4>
            </div>
        @endif
        @foreach($posts as $post)
        <div class="post row">
            <div class="wrap-ut col-md-8">
                <div class="row">
                    <div class="userinfo col-md-2">
                        <div class="avatar">
                            <img src="{{asset($post->user->avatar)}}" alt=""/>
                        </div>
                    </div>
                    <div class="posttext col-md-10">
                        <h2><a href="{{route('post.show', ['slug' => $post->slug])}}">{{$post->title}}</a></h2>
                        <div class="user-name">
                            <i class="fa fa-user"></i> {{$post->user->name}}
                        </div>
                        {!! $post->encode_content !!}
                        <ul class="tags">
                            @foreach($post->tags as $tag)
                            <a href="?tags={{$tag->name}}"><li class="badge">{{$tag->name}}</li></a>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="postinfo pull-left">
                <div class="comments">
                    <div class="commentbg">
                        {{$post->count_comments}}
                        <div class="mark"></div>
                    </div>

                </div>
                <div class="views"><i class="fa fa-eye"></i> {{$post->view}}</div>
                <div class="time"><i class="fa fa-clock-o"></i> {{formatDate($post->created_at)}}</div>
            </div>
            <div class="clearfix"></div>
        </div><!-- POST -->
        @endforeach
    </div>
@endsection
