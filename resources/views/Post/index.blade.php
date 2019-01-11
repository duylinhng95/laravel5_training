@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a href="{{url('/user/post/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new post</a>
        <a href="{{url('/auth/logout')}}" class="btn btn-danger float-right">Logout</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-light text-dark">
                <thead class="text-center">
                <tr>
                    <th>Title</th>
                    <th>Created Date</th>
                </tr>
                </thead>
                @foreach($posts as $post)
                    <tr>
                        <td style="width: 65%">{{$post->title}}</td>
                        <td style="width: 15%" class="text-center">{{$post->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
