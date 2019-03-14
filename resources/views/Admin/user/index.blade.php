@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Users </h2>
@endsection
@section('content')
    <div class="card-header">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <a class="btn btn-primary" href="{{route('admin.user.create')}}"><i class="fa fa-plus"></i> Add User</a>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary btn-search" id="searchBtnUser"><i
                                    class="fa fa-search "></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
            <td>#</td>
            <td>Name
                <button class="btn btn-xs" id="nameSort"><i class="fa fa-arrow-down" id="name"></i><input type="hidden"
                                                                                                          value="name">
                </button>
            </td>
            <td>Email
                <button class="btn btn-xs" id="emailSort"><i class="fa fa-arrow-down" id="email"></i><input
                            type="hidden" value="email"></button>
            </td>
            <td>Status
                <button class="btn btn-xs" id="statusSort"><i class="fa fa-arrow-down" id="status"></i><input
                            type="hidden" value="status"></button>
            </td>
            <td>Role</td>
            <td>Action</td>
            </thead>
            <tbody id="loader">
            @foreach($users as $index => $user)
                <tr id="{{$user->id}}">
                    <td>{{++$index}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td id="userStatus">
                        {{$user->get_status}}
                    </td>
                    <td>
                        {{implode(' ',$user->getRoles())}}
                    </td>
                    <td id="action">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Action</button>
                        <ul class="dropdown-menu action-dropdown">
                            @include('Admin.user.partial.dropdown')
                        </ul>
                    </td>
                </tr>
            @endforeach
            {{$users->links()}}
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection
