@extends('Post.layout')
@section('content')
    <div class="col-lg-8 col-md-8 detail-post">

        <!-- POST -->
        <div class="post">
            <div class="topwrap">
                <div class="userinfo pull-left">
                    <div class="avatar">
                        <img src={{asset($post->user->avatar)}} alt="">
                    </div>
                </div>
                <div class="posttext pull-left">
                    <h2>{{$post->title}}</h2>
                    <input type="hidden" value="{{$post->category->name}}" id="categoryName">
                    <div class="tags" id="postTag">
                        @foreach($post->tags as $tag)
                            <a href="{{url('/?tags='.$tag->name)}}" class="btn btn-default btn-sm badge"
                               type="submit">{{$tag->name}}</a>
                        @endforeach
                    </div>
                    <div class="detail-content">
                        {!! $post->content !!}
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="postinfobot">

                <div class="likeblock pull-left">
                    <a class="up" id="btnVotePost" data-post-id="{{$post->slug}}"
                       @if(Auth::id() == $post->user->id || !Auth::check())  disabled @endif>
                        <i class="fa fa-thumbs-o-up"></i><span id="voteNum">{{count($post->votes)}}</span>
                    </a>
                </div>
                <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on
                    : {{formatDate($post->created_at, 'd-m-Y h:m:s')}}</div>

                <div class="clearfix"></div>
            </div>
        </div><!-- POST Detail-->
        {{--Comment Section--}}
        <div class="panel comment-section">
            <div class="comment-body ">
                <div class="comment-list">
                    @foreach($post->comments as $comment)
                        @include('Post.partial.comment', ['comment' => $comment])
                    @endforeach
                </div>
                {{--Comment Form--}}
                @if(Auth::check())
                    <div class="post" id="comment-form">
                        <div class="topwrap">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src={{asset(Auth::user()->avatar)}} alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <div class="textwraper">
                                    <input type="hidden" name="token" value="{{csrf_token()}}" id="csrf_token">
                                    <div class="postreply">Post a Reply</div>
                                    <div class="text-danger" id="error_message"></div>
                                    <textarea name="content" placeholder="Type your message here"
                                              id="commentContent"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfobot">
                            <div class="pull-right postreply">
                                <div class="pull-left">
                                    <button type="button" class="btn btn-primary form-btn"
                                            id="btnComment"> Post comment
                                        <input type="hidden" name="postId" id="postId" value="{{$post->slug}}">
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    @include('Post.partial.right-sidebar')
@endsection
@push('script')
    <script src="{{mix('js/interest.js')}}"></script>
@endpush
