<div class="col-md-3 col-sm-4 col-xs-6 sidebar-offcanvas" id="sidebar">
    <!--========================== left-sidebar ================================-->
    <div class="left-sidebar">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingOne">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" href="{{url('/')}}" >Newest</a>
                    </h4>
                </div>
            </div>
            @foreach($categories as $category)
            <div class="panel panel-default">
                <div class="panel-heading" id="headingOne">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" href="{{url('?category='.$category->id)}}" >{{$category->name}}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div><!-- left-sidebar -->
</div>
