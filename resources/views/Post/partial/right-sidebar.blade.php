<!--========================== Right-Sidebar ================================-->
<div class="col-md-3 col-sm-12 col-xs-12">
    <div class="right-sidebar">
        <div class="righ-sidebar-body">
            <div class="item">
                <a href="#"><h4 class="post-title slide-title">popular posts</h4></a>
                @foreach($posts as $post)
                    <div class="col-md-12 col-sm-6">
                        <div class="carousel-caption">
                            <a href="#"><h5 class="post-title">{{$post->title}}</h5></a>
                            <div class="post-meta">
                                <span><i class="fa fa-calendar-check-o post-meta-icon"></i> {{formatDate($post->created_at)}} </span>
                                <span><i
                                            class="fa fa-comments post-meta-icon"></i> {{$post->count_comments}} </span>
                            </div>
                            <div class="post-content no-border">
                                {!! $post->encode_content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="item">
                <a href="#"><h4 class="post-title slide-title">popular tags</h4></a>
                @foreach($tags as $tag)
                    <a href="{{url('?tags='.$tag->name)}}" class="btn btn-default btn-sm btn-tags"
                       type="submit">{{$tag->name}}</a>
                @endforeach
            </div>
        </div><!-- Righ-sidebar-body -->
    </div><!-- Right-Sidebar -->
</div>
