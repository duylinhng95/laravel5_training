<div class="post">
    <div class="topwrap">
        <div class="userinfo pull-left">
            <div class="avatar">
                <img src={{asset($comment->user->avatar)}} alt="">
            </div>
        </div>
        <div class="posttext pull-left">
            <div class="user-name">
                {{$comment->user ? $comment->user->name : 'User'}}
            </div>
            <p>{{$comment->content}}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfobot">
        <div class="posted pull-left"><i class="fa fa-clock-o"></i> Commented on
            : {{formatDate($comment->created_at)}}</div>
        <div class="clearfix"></div>
    </div>
</div>
