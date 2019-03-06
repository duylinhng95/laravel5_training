@extends('Post.layout')
@section('content')
    <div class="col-md-4 col-lg-4 left-sidebar" id="browseWidget">
        <div class="sidebarblock">
            <h3><i class="fa fa-search"></i> Search</h3>
            <div class="divline"></div>
            <div class="blocktxt browse-widget-search">
                    <input type="text" name="search" id="searchPost">
                    <button class="btn btn-lg btn-info"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="sidebarblock">
            <h3><i class="fa fa-filter"></i> Sort</h3>
            <div class="divline"></div>
            <div class="blocktxt">
                    <ul class="browse-widget-filter">
                        <li><a href="?sort=views"><i class="fa fa-arrow-down"></i>Views</a></li>
                        <li><a href="?sort=comments"><i class="fa fa-arrow-down"></i>Comments</a></li>
                        <li><a href="?sort=created_at"><i class="fa fa-arrow-down"></i>Created Date</a></li>
                    </ul>
            </div>
        </div>

        <div class="sidebarblock">
            <h3><i class="fa fa-list-ul"></i> Categories</h3>
            <div class="divline"></div>
            <div class="blocktxt browse-widget-category">
                @foreach($categories as $category)
                    <div>
                        <input type="checkbox" name="category" value="{{$category->name}}" id="{{$category->name}}">
                        <label for="{{$category->name}}">{{$category->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sidebarblock">
            <h3><i class="fa fa-tags"></i> Tags</h3>
            <div class="divline"></div>
            <div class="blocktxt">
                @foreach($tags as $tag)
                    <div>
                        <input type="checkbox" name="category" value="{{$tag->name}}" id="{{$tag->name}}">
                        <label for="{{$tag->name}}">{{$tag->name}}</label>
                    </div>
                @endforeach
                <button type="button" class="load-more"><i class="fa fa-plus"></i> Load more...</button>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-8">
        <div class="post row">
            <h2 class="notification-heading"><i class="fa fa-arrow-alt-circle-left"></i> Go on. Search something...</h2>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{mix('js/browse.js')}}"></script>
@endpush
