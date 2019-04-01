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
            @foreach($users as $i => $u)
                <tr id="{{$u->id}}">
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td id="status">
                        @switch($u->status)
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
                    <td>{{$u->role ? 'Admin' : 'User'}}</td>
                    <td>{{$u->rating}}</td>
                    <td id="action">
                        <button class="btn btn-danger" onclick='blockUser({{$u->id}})'
                                @if($u->status == 2) disabled @endif>Block User
                        </button>
                        <button class="btn btn-success" onclick="unBlockUser({{$u->id}})"
                                @if($u->status != 2) disabled @endif>Unblock User
                        </button>
                    </td>
                </tr>
            @endforeach
            {{$users->links()}}
            </tbody>
        </table>
    </div>
@endsection
@section('script')
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
@endsection
