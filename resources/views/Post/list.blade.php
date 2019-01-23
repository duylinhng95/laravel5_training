@extends('Post.layout')
@section('search')
    @include('Post.search')
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a href="{{url('/user/post/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new post</a>
    </div>
    <div class="card-body">
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
                        <td style="width: 65%"><a href="{{route('user.post.edit',['id' => $post->id])}}">{{$post->title}}</a></td>
                        <td style="width: 15%" class="text-center">{{$post->created_at}}</td>
                        <td>{{$post->view}}</td>
                        <td>{{$post->count_votes}}</td>
                        <td>{{$post->count_comments}}</td>
                        <td style="width: 15%">
                            <a href="{{route('user.post.show',['id' => $post->id])}}" class="btn btn-primary"><i class="fa fa-info-circle"></i>
                                View</a>
                            <a href="{{route('user.post.edit',['id' => $post->id])}}" class="btn btn-info"><i
                                        class="fa fa-pen"></i>
                                Edit</a>
                            <button id="btnDeletePost" class="btn btn-danger">
                                <input type="hidden" id="postId" value="{{$post->id}}">
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
@push('script')
    <script>
	    var deletePostURI = "{{url('user/post/')}}/";
	    var csrf_token = "{{csrf_token()}}";
    </script>
@endpush
