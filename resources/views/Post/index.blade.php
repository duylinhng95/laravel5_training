@extends('Post.layout')
@section('search')
    @include('Post.search')
@endsection
@push('header')
    @include('Post.partial.header')
@endpush
@push('left-sidebar')
    @include('Post.partial.left-sidebar')
@endpush
@section('content')
    <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="main-content">
            @if($posts->isEmpty())
                <div class="text-center">
                    <h4>There are no post can be found</h4>
                </div>
            @endif
            @foreach($posts as $post)
            <article>
                <a href="{{route('post.show', ['id' => $post->id])}}"><h2 class="post-title">{{$post->title}}</h2></a>
                @foreach($post->tags as $tag)
                    <a href="?tags={{$tag->name}}" class="btn btn-default btn-sm btn-category"
                       type="submit">{{$tag->name}}</a>
                @endforeach
                <div class="post-meta">
                    <span><i class="fa fa-eye post-meta-icon"></i> {{$post->view}} </span>
                    <span><i class="fa fa-comments post-meta-icon"></i> {{$post->count_comments}} </span>
                    <span><i class="fa fa-calendar-check-o post-meta-icon"></i> {{formatDate($post->created_at)}} </span>
                </div>
                <div class="post-content">
                    {!! $post->encode_content !!}
                </div>
            </article>
            @endforeach
        </div><!-- main-content -->
        {{$posts->links()}}
    </div>
@endsection
@push('right-sidebar')
    @include('Post.partial.right-sidebar')
@endpush
