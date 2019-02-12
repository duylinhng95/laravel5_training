<footer>
    <div class="footer-menu">
            <div class="container">
                <div class="col-md-4 col-sm-4 center-block">
                    <h3 class="footer-head">NeoLog</h3>
                    <p>Create by Duy Linh Nguyen</p>
                    <div class="social">
                        <li><a href="https://www.facebook.com/linh.d.nguyen.3"><i class="fa fa-facebook facebook"></i></a></li>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 mobile-footer center-block">
                    <h4 class="footer-head">recent posts</h3>
                        <ul class="ul-left">
                            @foreach($latestPost as $post)
                                <li><a href="#">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                </div>
                <div class="col-md-4 col-sm-4 mobile-footer center-block">
                    <h4 class="footer-head">article categories</h4>
                    @foreach($categories->split(2) as $k => $split)
                        <ul class="@if($k ===0) ul-left @else ul-right @endif">
                            @foreach ($split as $category)
                                <li><a href="{{route('category.show', ['id' => $category->id])}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 text-center">
                <p>&copy; 2019 Duy Linh Nguyen</p>
            </div>
    </div><!-- Footer-menu -->
</footer>
