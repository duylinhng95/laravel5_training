@extends('Post.layout')
@section('search')
    @include('Post.search')
@endsection
@section('content')
    <!-- MAIN SECTION -->
    <div class="container featured-area-default padding-30">
        <div class="row">
            <div class="col-md-8 padding-20">
                <div class="row">
                    <!-- ARTICLES CATEGORIES SECTION -->
                    <div class="fb-heading">
                        Category List
                    </div>
                    <hr class="style-three">
                    <!-- END ARTICLES CATEOGIRES SECTION -->
                </div>
                @foreach($categories as $category)
                    <div class="row">
                        <div class="col-md-12 margin-bottom-20">
                            <div class="fat-heading-abb">
                                <i class="fa fa-folder"></i> {{$category->name}}
                                <span class="cat-count">({{count($category->posts)}})</span>
                            </div>
                            <div class="fat-content-small padding-left-30">
                                <ul>
                                    @foreach($category->posts->take(5) as $post)
                                        <li>
                                            <a href="{{url('post/' . $post->id)}}">
                                                <i class="fa fa-file-text-o"></i> {{$post->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('Post.sidebar')
        </div>
    </div>
    <!-- END MAIN SECTION -->
@endsection

