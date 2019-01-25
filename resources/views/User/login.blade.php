@extends('User.layout')
@section('title')
    Login to the System
@endsection
@section('content')
    <div class="card-header">
        <h2>Login</h2>
        @if(session('code'))
            <div class="alert alert-danger">
                <div class="col-md-6">
                    {{session('message')}}
                </div>
            </div>
        @endif
    </div>
    <form action="{{route('auth.login')}}" method="post">
        <div class="card-body">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-default" type="submit">Login</button>
            <a class="btn btn-secondary" href="{{route('auth.register')}}">Register</a>
            <a class="btn btn-primary" href="{{route('post.index')}}">Back to homepage</a>
        </div>
    </form>
@endsection
