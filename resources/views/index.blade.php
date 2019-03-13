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
    <header>
        <!--========================== Header-Top ================================-->
        <div class="header-top">
            <div class="container">
                <div class="col-md-9 col-sm-7 xs-view">
                    <a href="index.html"><img class="logo" src="images/logo.png" alt="Logo"/></a>
                </div>
                <div class="col-md-3 col-sm-5 xs-view-right">
                    <div class="search-section center-block">
                        <form>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Search">
                            <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Author -->
                    <div class="author-form">
                        <li class="dropdown">
                            <form>
                                <a href="#" class="dropdown-toggle author-icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user author-icon"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a class="sign" href="#signin" aria-controls="signin" role="tab" data-toggle="tab">sign in</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="sign" href="#signup" aria-controls="signup" role="tab" data-toggle="tab">sign up</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="signin">
                                            <ul class="user-dropdown">
                                                <div class="login-area">
                                                    <div class="form-group">
                                                        <label for="exampleInputText1">Username</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                </div>
                                                <div class="checkbox">
                                                    <input id="option" type="checkbox" name="field" value="option">
                                                    <label for="option"><span><span></span></span>Keep me singed in</label>
                                                    <a href="#" class="pull-right">Forgot?</a>
                                                </div>
                                                <div class="form-submit">
                                                    <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                </div>
                                            </ul><!-- /User-Dropdown-->
                                        </div><!-- /#Sing in -->
                                        <div role="tabpanel" class="tab-pane" id="signup">
                                            <ul class="user-dropdown">
                                                <div class="login-area">
                                                    <div class="form-group">
                                                        <label for="exampleInputText1">Username </label>
                                                        <input type="email" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email Address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Comfirm Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                </div>
                                                <div class="checkbox">
                                                    <input id="option1" type="checkbox" name="field" value="option1">
                                                    <label for="option1"><span><span></span></span>I accept Terms and Condition ?</label>
                                                </div>
                                                <div class="form-submit">
                                                    <button type="submit" class="btn btn-success btn-block">Sign up</button>
                                                </div>
                                            </ul><!-- /User-Dropdown-->
                                        </div><!-- /#Sing up -->
                                    </div><!-- /Tab-Content -->
                                </ul><!-- /Dropdown-menu -->
                            </form>
                        </li><!-- /Dropdown -->
                    </div><!-- /Author -->
                </div>
            </div>
        </div><!-- header-top -->

        <!--========================== Header-Nav ================================-->
        <div class="header-nav">
            <nav class="navbar navbar-default">
                <div class="container">
                    <p class="pull-left visible-xs">
                        <button type="button" class="navbar-toggle" data-toggle="offcanvas">
                            <i class="fa fa-long-arrow-right"></i>
                            <i class="fa fa-long-arrow-left"></i>
                        </button>
                    </p>
                    <div class="social-nav center-block visible-xs">
                        <li><a href="#"><i class="fa fa-twitter twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus google-plus"></i></a></li>
                    </div>
                    <!--toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="index.html">home</a></li>
                            <li><a href="about.html">about</a></li>
                            <li><a href="contact.html">contact</a></li>
                            <li><a href="details.html">Post Details</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right hidden-xs">
                            <li><a href="#"><i class="fa fa-twitter twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus google-plus"></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-->
            </nav>
        </div><!-- Header-Nav -->
    </header>
    <!--========================== Contant-Area================================-->
    <div class="contant-area">
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-md-3 col-sm-4 col-xs-6 sidebar-offcanvas" id="sidebar">
                    <!--========================== left-sidebar ================================-->
                    <div class="left-sidebar">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Top Reted
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">branding
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">business
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">design
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Html
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSix">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">inspiration
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">javascript
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingEight">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">mobile
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingNine">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">ux desing
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTen">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">web development
                                            <i class="fa fa-angle-right"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Lorern ipsum</a></li>
                                            <li><a href="#">Dolor sit amet</a></li>
                                            <li><a href="#">Consectetur</a></li>
                                            <li><a href="#">Adipisicing elit</a></li>
                                            <li><a href="#">tempor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- left-sidebar -->
                </div>
                <!--========================== main-content ================================-->
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <div class="main-content">
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-1.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">business</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">React To The Future With Isomorphic Apps</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>Things often come full circle in software engineering. The web in particular started with servers delivering content down to the client. Recently with the creation of modern web frameworks such as Angular JS and Ember, we've seen a push to render on the client and only use a server for an API</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-2.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">The Current State Of E-Commerce Filtering</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>Things often come full circle in software engineering. The web in particular started with servers delivering content down to the client. Recently, with the creation of modern web.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-3.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">The Current State Of E-Commerce Filtering</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>Things often come full circle in software engineering. The web in particular started with servers delivering content down to the client. Recently, with the creation of modern web.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-9.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to fantasy</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>This is the last year that the original version of Kraft Mac & Cheese sold in the U.S. will contain artificial preservatives or synthetic colors.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-5.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to fantasy</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>This is the last year that the original version of Kraft Mac & Cheese sold in the U.S. will contain artificial preservatives or synthetic colors.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-6.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to fantasy</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>This is the last year that the original version of Kraft Mac & Cheese sold in the U.S. will contain artificial preservatives or synthetic colors.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-7.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">nature</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">Polynesia is as close to fantasy</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content">
                                <p>This is the last year that the original version of Kraft Mac & Cheese sold in the U.S. will contain artificial preservatives or synthetic colors.</p>
                            </div>
                        </article>
                        <article>
                            <div class="post-img">
                                <a href="details.html" target="_blank"><img class="img-responsive" src="images/user/post-img-10.jpg" alt="Post"/></a>
                            </div>
                            <a href="details.html" target="_blank" class="btn btn-default btn-sm btn-category" type="submit">people</a>
                            <a href="details.html" target="_blank"><h2 class="post-title">Final 'Top Gear' footage with Jeremy Clarkson will be shown, says BBCas one can get</h2></a>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-share-alt post-meta-icon"></i> 400 Shares </a></span>
                                <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 20 Comments </a></span>
                                <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                            </div>
                            <div class="post-content no-border">
                                <p>Things often come full circle in software engineering. The web in particular started with servers delivering content down to the client. Recently with the creation of modern web frameworks such as Angular JS and Ember, we've seen a push to render on the client and only use a server for an API</p>
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
                <!--========================== Right-Sidebar ================================-->
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="right-sidebar">
                        <div class="righ-sidebar-body">
                            <div class="item">
                                <a href="#"><h4 class="post-title slide-title">popular posts</h4></a>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-1.jpg" alt="slider"></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">migrant crisis</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-2.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">kraft mac & cheese is ditching signature</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-3.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">denmark passes law banning bestiality</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-4.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-5.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-6.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#"><h4 class="post-title slide-title">featured posts</h4></a>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-7.jpg" alt="slider"></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">migrant crisis</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-8.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">kraft mac & cheese is ditching signature</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-9.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">denmark passes law banning bestiality</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-10.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-11.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <a href="#"><img src="images/user/right-post-img-12.jpg" alt="Post"/></a>
                                    <div class="carousel-caption">
                                        <a href="#"><h5 class="post-title">what welearned about microsoft at e3 2015</h5></a>
                                        <div class="post-meta">
                                            <span><a href="#"><i class="fa fa-calendar-check-o post-meta-icon"></i> april 13, 2015 </a></span>
                                            <span><a href="#"><i class="fa fa-comments post-meta-icon"></i> 50 </a></span>
                                        </div>
                                        <div class="post-content no-border">
                                            <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 post-static">
                                <h5 class="post-title">email newsletter</h5>
                                <div class="post-content no-border">
                                    <p>Migrant survivor says Mediterranean shipwreck was like a war scene'.</p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 email-section">
                                <form>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email address">
                                    <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div><!-- Righ-sidebar-body -->
                    </div><!-- Right-Sidebar -->
                </div>
            </div>
        </div><!-- Container -->
    </div><!-- Content-area -->
    <footer>
        <div class="footer-menu">
            <div class="container">
                <div class="col-md-4 col-sm-4 center-block">
                    <h3 class="footer-head">this author blog from crea tivemine</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="social">
                        <li><a href="#"><i class="fa fa-facebook facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus google-plus"></i></a></li>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 mobile-footer center-block">
                    <h4 class="footer-head">recent posts</h3>
                        <ul class="ul-left">
                            <li><a href="#">Ut enim ad minim veniam</a></li>
                            <li><a href="#">Quis nostrud exercitation laboris</a></li>
                            <li><a href="#">Duis aute irure dolor reprehenderit</a></li>
                            <li><a href="#">Excepteur sint occaecat non</a></li>
                            <li><a href="#">Proident,sunt in culpa qui officia</a></li>
                            <li><a href="#">Accusantium doloremque</a></li>
                        </ul>
                </div>
                <div class="col-md-4 col-sm-4 mobile-footer center-block">
                    <h4 class="footer-head">article categories</h3>
                        <ul class="ul-left">
                            <li><a href="#">Academy</a></li>
                            <li><a href="#">Blogging</a></li>
                            <li><a href="#">Conversion</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">E-Commerce</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Infographics</a></li>
                            <li><a href="#">Launch</a></li>

                        </ul>
                        <ul class="ul-right">
                            <li><a href="#">Strategies</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">SEO</a></li>
                            <li><a href="#">Social</a></li>
                            <li><a href="#">Media</a></li>
                            <li><a href="#">Testing</a></li>
                            <li><a href="#">Twitter</a></li>
                        </ul>
                </div>
            </div>
        </div><!-- Footer-menu -->
        <div class="footer-nav">
            <div class="container">
                <div class="col-md-6 col-sm-5">
                    <p>&copy; 2015 Author bloging template</p>
                </div>
                <div class="col-md-6 col-sm-7">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">support</a></li>
                        <li><a href="#">careers</a></li>
                        <li><a href="#">terms use</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
            </div>
            <!-- Go TO TOP -->
            <div id="toTop" class="btn btn-info" style="display: block;">
                <span class="fa fa-angle-up"></span>
            </div><!-- /Go-to-top -->
        </div>
    </footer>
</div><!-- /Wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/vendor/user/bootstrap.min.js')}}"></script>
<script src ="{{asset('js/vendor/user/custom.js')}}"></script>
</script>
</body>
</html>
