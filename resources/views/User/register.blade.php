@extends('User.layout')
@section('title')
    Register to System
@endsection
@section('content')
    <div class="card-header">
        <h2>Register</h2>
    </div>
    <form action="{{url('/user/register')}}" method="post">
    {{csrf_field()}}
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
    </div>
    </form>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
@endsection
