@foreach($posts as $post)
<div class="blocktxt recommendPost">
    <div class="sidebar-post">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                                <span class="category">
                                    {{$post->category->name}}
                                </span>
            </div>
            <div class="col-md-8 col-lg-8">
                <div class="row">
                    <div class="title">
                        <h2><a href="{{route('post.show', ['slug' => $post->slug])}}">{{$post->title}}</a></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="content">
                        {!! $post->encode_content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tags col-md-12">
                @foreach ($post->tags as $tag)
                <a href="{{url('?tags='.$tag->name)}}" class="badge">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach
