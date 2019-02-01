<!--========================== Right-Sidebar ================================-->
<div class="col-md-3 col-sm-12 col-xs-12">
    <div class="right-sidebar">
        <div class="righ-sidebar-body">
            <div class="item">
                <a href="#"><h4 class="post-title slide-title">popular posts</h4></a>
                @foreach($posts as $post)
                <div class="col-md-12 col-sm-6">
                    <a href="#"><img src="images/user/right-post-img-1.jpg" alt="slider"></a>
                    <div class="carousel-caption">
                        <a href="#"><h5 class="post-title">{{$post->title}}</h5></a>
                        <div class="post-meta">
                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> {{formatDate($post->created_at)}} </a></span>
                            <span><a href="#"><i
                                            class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                        </div>
                        <div class="post-content no-border">
                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="item">
                <a href="#"><h4 class="post-title slide-title">popular tags</h4></a>
                @foreach($tags as $tag)
                    <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-tags" type="submit">nature</a>
                @endforeach
            </div>
        </div><!-- Righ-sidebar-body -->
    </div><!-- Right-Sidebar -->
</div>
