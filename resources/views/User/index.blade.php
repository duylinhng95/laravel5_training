@extends('Post.layout')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="panel">
            @if (session('error'))
                <div class="panel-heading">
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                </div>
            @endif
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 heading">
                            <h3>My Profile</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <a href="#avatarModal" class="change-avatar" data-toggle="modal">
                                <i class="fa fa-edit edit-btn"></i>
                                <img class="avatar-img"
                                     src="{{asset($user->avatar)}}"
                                     alt="My Profile Img">
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <div class="user-info">
                                <ul class="info-list">
                                    <li><h3>{{$user->name}}</h3></li>
                                    <li><i class="fa fa-at"><span> Email</span> </i>
                                        <p>{{$user->email}}</p></li>
                                    <li><i class="fa fa-angle-double-right"><span> Follows</span></i>
                                        <p>{{count($user->followings)}}</p></li>
                                    <li><i class="fa fa-book"><span> Post</span></i>
                                        <p>{{count($user->posts)}}</p></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="user-activity">
                                <ul class="activity-list">
                                    <li>
                                        <a href="{{route('user.post.index')}}" class="btn btn-primary"> Post Management</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('User.partial.avatar')
@endsection

