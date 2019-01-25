@extends('Post.layout')
@section('search')
    @include('User.search')
@endsection
@section('content')
    <div class="row">
        <!-- ARTICLE OVERVIEW SECTION -->
        <div class="col-md-12 padding-20">
            <div class="row">
                <!-- ARTICLES -->
                <div class="fb-heading">
                    All Users
                </div>
                <hr class="style-three">
                @foreach ($users as $user)
                    <div class="card post">
                        <div class="row">
                            <div class="col-6">
                                <div class="article-heading-abb">
                                    <i class="fa fa-pencil-square-o"></i> {{$user->name}}
                                </div>
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
                            <div class="col-6">
                                @if(Auth::user()->id != $user->id)
                                    @if(!Auth::user()->checkFollow($user->id))
                                        <a href="{{route('user.follow', ['id' => $user->id])}}" class="btn btn-primary">Follow</a>
                                    @else
                                        <a href="{{route('user.unfollow', ['id' => $user->id])}}"
                                           class="btn btn-danger">Unfollow</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- END ARTICLES -->
            @endforeach
            <!-- PAGINATION -->
                <div class="text-center">
                    {{$users->links()}}
                </div>
                <!-- END PAGINATION -->
            </div>
        </div>
        <!-- END ARTICLES OVERVIEW SECTION-->
    </div>
@endsection
