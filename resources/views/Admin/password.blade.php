@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Change Admin Password</h2>
    @if(session('code'))
        <div class="text-center alert alert-info">
            {{session('message')}}
        </div>
    @endif
@endsection
@section('content')
    <div class="card-header">Change admin password</div>
    <div class="card-body">
        <form action="{{route('admin.password.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="oldPwd">Old Password</label>
                <input type="password" class="form-control" name="oldPwd">
            </div>
            <div class="form-group">
                <label for="newPwd">New Password</label>
                <input type="password" class="form-control" name="newPwd">
            </div>
            <div class="form-group">
                <label for="newPwd_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" name="newPwd_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
