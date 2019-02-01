<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: Author ::</title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/vendor/user/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/font-awesome.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/offcanvas.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/homepage.css')}}"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="wrapper">
    @include('Post.partial.header')
    <!--========================== Contant-Area================================-->
        <div class="contant-area">
            <div class="container">
                <div class="row row-offcanvas row-offcanvas-left">
                @include('Post.partial.left-sidebar')
                <!--========================== main-content ================================-->
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="main-content">
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-1.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">business</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">React To The Future With
                                        Isomorphic Apps</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>Things often come full circle in software engineering. The web in particular started
                                        with servers delivering content down to the client. Recently with the creation of
                                        modern web frameworks such as Angular JS and Ember, we've seen a push to render on
                                        the client and only use a server for an API</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-2.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">The Current State Of
                                        E-Commerce Filtering</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>Things often come full circle in software engineering. The web in particular started
                                        with servers delivering content down to the client. Recently, with the creation of
                                        modern web.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-3.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">The Current State Of
                                        E-Commerce Filtering</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>Things often come full circle in software engineering. The web in particular started
                                        with servers delivering content down to the client. Recently, with the creation of
                                        modern web.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-9.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to
                                        fantasy</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>This is the last year that the original version of Kraft Mac & Cheese sold in the
                                        U.S. will contain artificial preservatives or synthetic colors.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-5.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to
                                        fantasy</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>This is the last year that the original version of Kraft Mac & Cheese sold in the
                                        U.S. will contain artificial preservatives or synthetic colors.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-6.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to
                                        fantasy</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>This is the last year that the original version of Kraft Mac & Cheese sold in the
                                        U.S. will contain artificial preservatives or synthetic colors.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-7.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">nature</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to
                                        fantasy</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content">
                                    <p>This is the last year that the original version of Kraft Mac & Cheese sold in the
                                        U.S. will contain artificial preservatives or synthetic colors.</p>
                                </div>
                            </article>
                            <article>
                                <div class="post-img">
                                    <a href="details.html" target="_blank"><img class="img-responsive"
                                                                                src="images/user/post-img-10.jpg"
                                                                                alt="Post"/></a>
                                </div>
                                <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category"
                                   type="submit">people</a>
                                <a href="details.html" target="_blank"><h2 class="post-title">Final 'Top Gear' footage with
                                        Jeremy Clarkson will be shown, says BBCas one can get</h2></a>
                                <div class="post-meta">
                                    <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                    <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                    <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                </div>
                                <div class="post-content no-border">
                                    <p>Things often come full circle in software engineering. The web in particular started
                                        with servers delivering content down to the client. Recently with the creation of
                                        modern web frameworks such as Angular JS and Ember, we've seen a push to render on
                                        the client and only use a server for an API</p>
                                </div>
                            </article>
                        </div><!-- main-content -->
                        <div class="pagination">
                            <nav>
                                <ul class="pagination">
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @include('Post.partial.right-sidebar')
                </div>
            </div><!-- Container -->
        </div><!-- Content-area -->
        @include('Post.partial.footer')
    </div><!-- /Wrapper -->
    <script src="{{mix('/js/post.js')}}"></script>
    <script src="{{asset('js/vendor/user/custom.js')}}"></script>
</body>
</html>
