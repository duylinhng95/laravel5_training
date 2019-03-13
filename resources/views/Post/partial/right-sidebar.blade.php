<div class="col-lg-4 col-md-4 right-sidebar">

    <!-- Categories -->
    @if(Auth::check())
        <div class="sidebarblock">
            <div class="divline"></div>
            <div class="blocktxt">
                <ul class="cats">
                    @if(Auth::id() != $post->user->id)
                        <button class="btn btn-primary btn-follow @if($followed === 1) d-none @endif"
                                data-user-id="{{$post->user->id}}">
                            Follow
                        </button>
                        <button class="btn btn-danger btn-unfollow @if($followed === 0) d-none @endif"
                                data-user-id="{{$post->user->id}}">
                            Unfollow
                        </button>
                    @endif
                    <a href="#comment-form" class="btn btn-info" id="btn-redirect"> Reply </a>
                </ul>
            </div>
        </div>
@endif

<!-- Tags -->
    <div class="sidebarblock">
        <h3><i class="fa fa-tag"></i> Popular Tags</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            @foreach($tags as $tag)
                <a href="{{url('?tags='.$tag->name)}}" class="badge">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>
</div>
