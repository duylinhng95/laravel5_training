@extends('Post.layout')
@section('title')
    Post List
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
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($posts as $post)
                    <tr>
                        <td style="width: 65%">{{$post->title}}</td>
                        <td style="width: 15%" class="text-center">{{$post->created_at}}</td>
                        <td style="width: 15%">
                            <a href="{{url('/user/post/'.$post->id)}}" class="btn btn-primary"><i class="fa fa-info-circle"></i>
                                View</a>
                            <a href="{{url('/user/post/'.$post->id.'/edit')}}" class="btn btn-info"><i
                                        class="fa fa-pen"></i>
                                Edit</a>
                            <button onclick="deletePost({{$post->id}})" class="btn btn-danger"><i
                                        class="fa fa-trash"></i> Delete
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
	    function deletePost(id) {
		    $.ajax({
			    url: "{{url('user/post/')}}/" + id,
			    type: "DELETE",
			    data: {_token: "{{csrf_token()}}"},
			    success: function (res) {
				    if (res.code == 200) {
					    location.reload();
				    }
			    }
		    })
	    }
    </script>
@endpush
