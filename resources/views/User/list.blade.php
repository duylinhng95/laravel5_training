@extends('Post.layout')
@section('content')
    <!-- ARTICLE OVERVIEW SECTION -->
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="search-section">
                    <input type="text" placeholder="Search" id="keywordsUser">
                    <button class="btn btn-default btn-xs" id="btnSearchUser"><i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        @if(count($users) == 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel user-panel text-center">
                        <b>User not found</b>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($users->chunk(3) as $split)
            <div class="row">
                @foreach($split as $user)
                    @if(!$user->checkRole('admin'))
                        <div class="panel col-md-4 user-panel">
                            <div class="row">
                                <div class="author-name col-md-offset-4">
                                    <h3>{{$user->name}}</h3>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="author-img">
                                        <img class="img-responsive img-circle" src="{{asset('images/avatar.png')}}"
                                             alt="author"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <ul class="author-info">
                                            <li><i class="fa fa-calendar-o"></i> {{formatDate($user->created_at)}}</li>
                                            <li><i class="fa fa-book"></i> {{$user->count_post}}</li>
                                            <li><i class="fa fa-thumbs-up"></i> {{$user->count_follow}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="section-follow">
                                    @if(Auth::user()->id != $user->id)
                                        <button class="btn btn-xs btn-primary btn-follow @if(Auth::user()->checkFollow($user->id)) d-none @endif"
                                                data-user-id="{{$user->id}}">
                                            <i class="fa fa-angle-double-right"></i>Follow
                                        </button>
                                        <button class="btn btn-xs btn-danger btn-unfollow @if(!Auth::user()->checkFollow($user->id)) d-none @endif"
                                                data-user-id="{{$user->id}}">
                                            <i class="fa fa-angle-double-left"></i>Unfollow
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
    <!-- PAGINATION -->
        <div class="text-center">
            {{$users->links()}}
        </div>
        <!-- END PAGINATION -->
    </div>
@endsection
