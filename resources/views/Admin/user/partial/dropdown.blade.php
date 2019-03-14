<li class="dropdown-item">
    <a href="{{route('admin.user.edit', ['id' => $user->id])}}"
       class="btn btn-primary">Edit</a>
</li>
<li class="dropdown-item section-block">
    @if($user->status !== 2)
        <button class="btn btn-danger btn-block" data-user-id="{{$user->id}}">Block
        </button>
    @else
        <button class="btn btn-success btn-block" data-user-id="{{$user->id}}">
            Unblock
        </button>
    @endif
</li>
<li class="dropdown-item">
    <a href="{{route('admin.user.delete', ['id' => $user->id])}}"
       class="btn btn-danger"
       onclick="return confirm('Are you sure?')">Delete</a>
</li>
