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
    function importUser() {
	    $.ajax(
		    {
			    url: "{{url('/admin/user/import')}}",
			    type: "GET",
			    success: function (res) {
				    location.reload();
			    }
		    }
	    );
    }

    function blockUser(id) {
	    $.ajax({
		    url: "{{url('/admin/user/block')}}",
		    type: "GET",
		    data: {id: id},
		    success: function (res) {
			    $('#' + res.id).find('#status').text('Block');
			    $('#' + res.id).find('#action').html('');
			    $('#' + res.id).find('#action').append(
				    "<button class='btn btn-danger' onclick='blockUser(" + res.id + ")' disabled>Block User</button>" +
				    " <button class='btn btn-success' onclick='unBlockUser(" + res.id + ")'>Unblock User</button>"
			    )
		    }
	    });
    }

    function unBlockUser(id) {
	    $.ajax({
		    url: "{{url('/admin/user/unblock')}}",
		    type: "GET",
		    data: {id: id},
		    success: function (res) {
			    if (res.status == 1) {
				    $('#' + res.id).find('#status').text('Active');
			    } else {
				    $('#' + res.id).find('#status').text('Not Active');
			    }
			    $('#' + res.id).find('#action').html('');
			    $('#' + res.id).find('#action').append(
				    "<button class='btn btn-danger' onclick='blockUser(" + res.id + ")' >Block User</button>" +
				    " <button class='btn btn-success' onclick='unBlockUser(" + res.id + ")' disabled>Unblock User</button>"
			    )
		    }
	    })
    }
</script>
@endpush
