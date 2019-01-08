@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Cards </h2>
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
            </thead>
            <tbody>
                @foreach($users as $i => $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    @switch($u->status)
                        @case(0)
                        <td>Not Active</td>
                        @break
                        @case(1)
                        <td>Active</td>
                        @break
                        @case(2)
                        <td>Block</td>
                        @break
                    @endswitch
                    <td>{{$u->role ? 'Admin' : 'User'}}</td>
                    <td>{{$u->rating}}</td>
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
				url:"{{url('/admin/user/import')}}",
                type: "GET",
                success: function ($res) {
					location.reload();
                }
			}
		);
	}
</script>
@endsection
