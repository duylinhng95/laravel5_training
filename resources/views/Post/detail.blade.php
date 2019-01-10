@extends('Post.layout')
@section('title')
    Post List
@endsection
@section('content')
    <div class="card-header">
        <h2>Post</h2>
        <a href="{{url('/user/post')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
    </div>
    <div class="card-body">
        <div class="row">
            <ul>
                <li>Author: {{$post->user->name}}</li>
                <li>Tags: <input type="text" value="{{$tags}}" data-role="tagsinput" disabled></li>
                <li>Created Date: {{$post->created_at}}</li>
                <li>Content:</li>
                {{$post->content}}
            </ul>
        </div>
    </div>
    <div class="card-footer">

    </div>
@endsection
@push('script')
    <script src="{{mix('js/post.js')}}"></script>
@endpush
