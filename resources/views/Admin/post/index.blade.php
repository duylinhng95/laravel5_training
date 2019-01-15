@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Post </h2>
@endsection
@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="searchPostBtn" onclick="searchPost()"><i
                                    class="fa fa-search "></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Category</td>
                    <td>Author</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $index => $post)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->user->name}}</td>
                    <td><a href="{{url('admin/post/'.$post->id)}}" class="btn btn-primary">View</a></td>
                </tr>
                @endforeach
            {{$posts->links()}}
            </tbody>
        </table>
    </div>
@endsection
@push('script')
    <script>
	    $(document).keypress(function(event){

		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
			    $("#searchBtn").click();
		    }

	    });
    </script>
@endpush
