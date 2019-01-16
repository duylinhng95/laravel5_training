<!-- SIDEBAR STUFF -->
<div class="col-md-4 padding-20">

    <div class="row margin-top-20">
        <div class="col-md-12">
            <div class="fb-heading-small">
                Popular Articles
            </div>
            <hr class="style-three">
            <div class="fat-content-small padding-left-10">
                <ul>
                    @foreach($post->getPopularPost(5) as $post)
                        <li>
                            <a href="{{url('post/'.$post->id)}}">
                                <i class="fa fa-file-text-o"></i> {{$post->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row margin-top-20">
        <div class="col-md-12">
            <div class="fb-heading-small">
                Latest Articles
            </div>
            <hr class="style-three">
            <div class="fat-content-small padding-left-10">
                <ul>
                    @foreach($post->getLatestPost(5) as $post)
                        <li>
                            <a href="{{url('/post/'.$post->id)}}">
                                <i class="fa fa-file-text-o"></i> {{$post->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- POPULAR TAGS (SHOW MAX 20 TAGS) -->
    <div class="row margin-top-20">
        <div class="col-md-12">
            <div class="fb-heading-small">
                Popular Tags
            </div>
            <hr class="style-three">
            <div class="fat-content-tags padding-left-10">
                @foreach($tags as $tag)
                    <a href="{{url('/post?keyword='.$tag->name)}}" class="btn btn-default btn-o btn-sm">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END POPULAR TAGS (SHOW MAX 20 TAGS) -->
</div>
<!-- END SIDEBAR STUFF -->
