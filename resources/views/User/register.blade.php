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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form action="{{url('/auth/register')}}" method="post">
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group">
                <label for="email">Email</label>
                @if($errors->has('email'))
                    <div class="text-danger">
                        {{$errors->first('email')}}
                    </div>
                @endif
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                @if($errors->has('password'))
                    <div class="text-danger">
                        {{$errors->first('password')}}
                    </div>
                @endif
                <input type="password" name="password" class="form-control">
            </div>
        </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
    </form>
@endsection
