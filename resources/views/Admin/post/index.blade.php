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
                    <button class="btn btn-xs" id="titleSort"><i class="fa fa-arrow-down" id="title"></i><input
                                type="hidden" value="title">
                    </button>
                </th>
                <th>Category
                    <button class="btn btn-xs" id="categorySort"><i class="fa fa-arrow-down"
                                                                    id="category"></i><input
                                type="hidden" value="category"></button>
                </th>
                <th>Author
                    <button class="btn btn-xs" id="userSort"><i class="fa fa-arrow-down" id="user"></i><input
                                type="hidden" value="user">
                    </button>
                </th>
                <th>Status
                    <button class="btn btn-xs" id="deletedAtSort"><i class="fa fa-arrow-down"
                                                                     id="deleted_at"></i><input
                                type="hidden" value="deleted_at"></button>
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
                    <td><a href="{{route('admin.post.show', ['id'=>$post->id])}}" class="btn btn-primary">View</a></td>
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
