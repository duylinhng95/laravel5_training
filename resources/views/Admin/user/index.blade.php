@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Users </h2>
@endsection
@section('content')
    <div class="card-header">
        <button onclick="importUser()" class="btn btn-primary"> Import User</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
            <td>#</td>
            <td>Name</td>
            <td>Email</td>
            <td>Status</td>
            <td>Role</td>
            <td>Rating</td>
            <td>Action</td>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
                <tr id="{{$user->id}}">
                    <td>{{$user->id}}</td>
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
                    <td>{{$user->role ? 'Admin' : 'User'}}</td>
                    <td>{{$user->rating}}</td>
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
	var importUserURI = "{{url('/admin/user/import')}}";
	var blockUserURI = "{{url('/admin/user/block')}}";
	var unBlockUserURI = "{{url('/admin/user/unblock')}}";
</script>
@endpush
