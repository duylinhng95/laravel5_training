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
                <th>#</th>
                <th>Title
                    <button onclick="sortPost('title')" class="btn btn-xs"><i class="fa fa-arrow-down" id="title"></i>
                    </button>
                </th>
                <th>Category
                    <button onclick="sortPost('category')" class="btn btn-xs"><i class="fa fa-arrow-down"
                                                                                 id="category"></i></button>
                </th>
                <th>Author
                    <button onclick="sortPost('user')" class="btn btn-xs"><i class="fa fa-arrow-down" id="user"></i>
                    </button>
                </th>
                <th>Status
                    <button onclick="sortPost('deleted_at')" class="btn btn-xs"><i class="fa fa-arrow-down"
                                                                                   id="deleted_at"></i></button>
                </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $index => $post)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->user->name}}</td>
                    @if($post->deleted_at != null)
                        <td class="text text-danger">Deleted</td>
                    @else
                        <td class="text text-success">Available</td>
                    @endif
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
			$(document).keypress(function (event) {
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if (keycode == '13') {
					$("#searchPostBtn").click();
				}
			});
    </script>
@endpush
