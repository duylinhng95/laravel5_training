@extends('Post.layout')
@section('title')
    User Detail
@endsection
@section('search')
    @include('User.search')
@endsection
@push('header')
    @include('Post.partial.header')
@endpush
@section('content')
    @if (session('error'))
        <div class="panel-heading">
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        </div>
    @endif
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h3>Information</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <th>Name:</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Follows:</th>
                        <td>{{count($user->followings)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <a href="{{route('user.post.index')}}" class="btn btn-success d-block">Post List</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Followers</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user->follows as $index => $follow)
                        <tr>
                            <td>
                                {{++$index}}
                            </td>
                            <td>
                                {{$follow->follower->name}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

