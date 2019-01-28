@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Users </h2>
@endsection
@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <button id="btnImportUser" class="btn btn-primary"> Import User</button>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="searchBtnUser"><i
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
            <tbody>
            @foreach($users as $index => $user)
                    <tr id="{{$user->id}}">
                        <td>{{++$index}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td id="status">
                            @switch($user->status)
                                @case(0)
                                Not Active
                                @break
                                @case(1)
                                Active
                                @break
                                @case(2)
                                Block
                                @break
                            @endswitch
                        </td>
                        <td>
                            @foreach($user->userRoles as $role)
                                {{$role->role->name}},
                            @endforeach
                        </td>
                        <td id="action">
                            <button class="btn btn-danger" onclick='blockUser({{$user->id}})'
                                    @if($user->status == 2) disabled @endif>Block User
                            </button>
                            <button class="btn btn-success" onclick="unBlockUser({{$user->id}})"
                                    @if($user->status != 2) disabled @endif>Unblock User
                            </button>
                        </td>
                    </tr>
            @endforeach
            {{$users->links()}}
            </tbody>
        </table>
    </div>
@endsection
@push('script')
    <script>
			var blockUserURI = "{{url('/admin/user/block')}}";
			var unBlockUserURI = "{{url('/admin/user/unblock')}}";
    </script>
@endpush
