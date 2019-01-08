@extends('User.layout')
@section('title')
    Register to System
@endsection
@section('content')
    <div class="card-header">
        <h2>Register</h2>
        @if(isset($result))
            <div class="alert alert-danger">{{$result['code']}} {{$result['message']}}</div>
        @endif
    </div>
    <form action="{{url('/auth/register')}}" method="post">
        {{csrf_field()}}
        <div class="card-body">
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
        <button type="submit" class="btn btn-success">Register</button>
    </div>
    </form>
@endsection
