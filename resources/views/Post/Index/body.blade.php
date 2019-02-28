@foreach($posts as $post)
    <div class="post row">
        <div class="wrap-ut col-md-8">
            <div class="row">
                <div class="userinfo col-md-2">
                    <div class="avatar">
                        <img src="{{asset('images/avatar.png')}}" alt=""/>
                    </div>
                    <div class="name">
                        <h4></h4>
                    </div>
                </div>
                <div class="posttext col-md-10">
                    <h2><a href="{{route('post.show', ['id' => $post->id])}}">{{$post->title}}</a></h2>
                    {!! $post->encode_content !!}
                    <ul class="tags">
                        @foreach($post->tags as $tag)
                            <a href="?tags={{$tag->name}}"><li class="badge">{{$tag->name}}</li></a>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="postinfo pull-left">
            <div class="comments">
                <div class="commentbg">
                    {{$post->count_comments}}
                    <div class="mark"></div>
                </div>

            </div>
            <div class="views"><i class="fa fa-eye"></i> {{$post->view}}</div>
            <div class="time"><i class="fa fa-clock-o"></i> {{formatDate($post->created_at)}}</div>
        </div>
        <div class="clearfix"></div>
    </div><!-- POST -->
@endforeach
