@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Post </h2>
@endsection
@section('content')
    <div class="card-header">
        Posts list
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $i => $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->title}}</td>
                    <td><a href="{{url('admin/post/'.$p->id)}}" class="btn btn-primary">View</a></td>
                </tr>
                @endforeach
            {{$posts->links()}}
            </tbody>
        </table>
    </div>
@endsection
