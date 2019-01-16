@extends('Post.layout')
@section('search')
    @include('Post.search')
@endsection
@section('content')
    <div class="row">
        <!-- ARTICLE OVERVIEW SECTION -->
        <div class="col-md-8 padding-20">
            <div class="row">
                <!-- ARTICLES -->
                <div class="fb-heading">
                    All Posts
                </div>
                <hr class="style-three">
                @foreach ($posts as $post)
                <div class="card post">
                    <div class="article-heading-abb">
                        <a href="{{url('post/'.$post->id)}}">
                            <i class="fa fa-pencil-square-o"></i> {{$post->title}}</a>
                    </div>
                    <div class="article-info">
                        <div class="art-date">
                                <i class="fa fa-calendar-o"></i> {{$post->format_created}}
                        </div>
                        <div class="art-category">
                            <a href="{{url('category/'.$post->category->id)}}">
                                <i class="fa fa-folder"></i> {{$post->category->name}} </a>
                        </div>
                        <div class="art-comments">
                            <i class="fa fa-user"></i> {{$post->user->name}}
                        </div>
                        <div class="art-comments">
                                <i class="fa fa-comments-o"></i> {{$post->count_comments}}
                        </div>
                    </div>
                    <div class="article-content">
                        <p class="block-with-text">
                            {!! $post->encode_content !!}
                        </p>
                    </div>
                    <div class="article-read-more">
                        <a href="{{url('/post/'.$post->id)}}" class="btn btn-default btn-wide">Read more...</a>
                    </div>
                </div>
                <!-- END ARTICLES -->
                @endforeach
                <!-- PAGINATION -->
                <div class="text-center">
                    {{$posts->links()}}
                </div>
                <!-- END PAGINATION -->
            </div>
        </div>
        <!-- END ARTICLES OVERVIEW SECTION-->
        @include('Post.sidebar')
    </div>
@endsection
