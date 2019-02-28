@extends('Post.layout')
@section('search')
    @include('Post.search')
@endsection
@section('content')
    <div class="panel-heading">
        <h2>Post</h2>
        <a href="{{route('user.post.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new post</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-light text-dark">
                <thead class="text-center">
                <tr>
                    <th>Title</th>
                    <th>Created Date</th>
                    <th>Views</th>
                    <th>Vote</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($posts as $post)
                    <tr>
                        <td style="width: 60%"><a href="{{route('user.post.edit',['slug' => $post->slug])}}">{{$post->title}}</a></td>
                        <td style="width: 10%" class="text-center">{{formatDate($post->created_at)}}</td>
                        <td>{{$post->view}}</td>
                        <td>{{$post->count_votes}}</td>
                        <td>{{$post->count_comments}}</td>
                        <td style="width: 40%">
                            <a href="{{route('user.post.show',['slug' => $post->slug])}}" class="btn btn-primary"><i class="fa fa-info-circle"></i>
                                View</a>
                            <a href="{{route('user.post.edit',['slug' => $post->slug])}}" class="btn btn-info"><i
                                        class="fa fa-pen"></i>
                                Edit</a>
                            <button class="btn btn-danger btn-delete-post">
                                <input type="hidden" id="postId" value="{{$post->slug}}">
                                {{csrf_field()}}
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
