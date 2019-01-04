@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a href="{{url('/post/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new post</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-light text-dark">
                <thead class="text-center">
                <th>Title</th>
                <th>Description</th>
                <th>Content</th>
                <th>Action</th>
                </thead>
                @foreach($posts as $p)
                    <tr>
                        <td>{{$p->title}}</td>
                        <td>{{$p->description}}</td>
                        <td>{{$p->content}}</td>
                        <td>
                            <a href="{{url('/post/'.$p->id.'/edit')}}" class="btn btn-info"><i class="fa fa-pen"></i> Edit</a>
                            <a href="{{url('/post/'.$p->id.'/delete')}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
