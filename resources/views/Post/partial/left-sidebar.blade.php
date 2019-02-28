<div class="col-lg-4 col-md-4">

    <!-- Categories -->
    <div class="sidebarblock">
        <h3><i class="fa fa-list-ul"></i> Categories</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <ul class="cats">
                @foreach($categories as $category)
                <a href="{{url('?category='.$category->id)}}">
                    <li>{{$category->name}} <span class="badge pull-right">{{$category->posts ? count($category->posts) : 0}}</span></li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>

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
