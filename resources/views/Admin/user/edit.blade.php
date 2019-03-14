@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Create New Users </h2>
@endsection
@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 col-lg-12 ">
                <h3>Account Information</h3>
            </div>
        </div>
    </div>
    <form action="{{route('admin.user.edit', ['id' => $user->id])}}" method="post">
        {{method_field("PUT")}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6 offset-md-3">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name"><span class="required">*</span> Full Name</label>
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                        <input type="text" class="form-control" name="name" placeholder="{{$user->name}}"
                               value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="required">*</span> Email</label>
                        @if($errors->has('email'))
                            <div class="text-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                        <input type="text" class="form-control" name="email" placeholder="{{$user->email}}" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="required">*</span> Password</label>
                        @if($errors->has('password'))
                            <div class="text-danger">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <div class="card">
                            <label for="status">Status</label>
                            @if($errors->has('status'))
                                <div class="text-danger">
                                    {{$errors->first('status')}}
                                </div>
                            @endif
                            <div class="card-body">
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="status" class="custom-control-input" value="0"
                                           @if($user->status === 0) checked @endif><span
                                            class="custom-control-label">Not Active</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="status" class="custom-control-input" value="1"
                                           @if($user->status === 1) checked @endif><span
                                            class="custom-control-label">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('admin.user')}}" class="btn btn-outline-warning">Cancel</a>
        </div>
    </form>
@endsection
@push('script')

@endpush
