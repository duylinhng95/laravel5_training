@extends('Post.layout')
@section('content')
    <!-- ARTICLE OVERVIEW SECTION -->
    <div class="col-md-8">
        <div class="search-section center-block searchfield">
            <input type="text" class="form-control" placeholder="Search" id="keywords">
            <button type="submit" class="btn btn-default btn-xs" id="btnSearchUser"><i class="fa fa-search"></i></button>
        </div>
        <!-- ARTICLES -->
        <div class="fb-heading">
            All Users
        </div>
        @foreach ($users->split(2) as $split)
            <div class="row">
                @foreach($split as $user)
                    @if(!checkAdmin($user, 'admin'))
                        <div class="author-img">
                            <img class="img-responsive img-circle" src="{{asset('images/avatar.png')}}"
                                 alt="author"/>
                        </div>
                        <div class="panel col-md-5 user-panel">
                            <div class="article-heading-abb">
                                {{$user->name}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="article-info">
                                        <div class="art-date">
                                            <i class="fa fa-calendar-o"></i> {{formatDate($user->created_at)}}
                                        </div>
                                        <div class="art-category">
                                            <i class="fa fa-book"></i> {{$user->count_post}}
                                        </div>
                                        <div class="art-comments">
                                            <i class="fa fa-thumbs-up"></i> {{$user->count_follow}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 section-follow">
                                    @if(Auth::user()->id != $user->id)
                                        <button class="btn btn-primary btn-follow @if(Auth::user()->checkFollow($user->id)) d-none @endif"
                                                data-user-id="{{$user->id}}">
                                            Follow
                                        </button>
                                        <button class="btn btn-danger btn-unfollow @if(!Auth::user()->checkFollow($user->id)) d-none @endif"
                                                data-user-id="{{$user->id}}">
                                            Unfollow
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- END ARTICLES -->
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
    <!-- PAGINATION -->
    <div class="text-center">
        {{$users->links()}}
    </div>
    <!-- END PAGINATION -->
@endsection
@push('right-sidebar')
    @include('Post.partial.right-sidebar')
@endpush
