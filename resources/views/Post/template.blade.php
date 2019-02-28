<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forum :: Home Page</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/vendor/user/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{mix('css/template.css')}}"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="container-fluid">
    <!-- Slider -->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <!-- SLIDE  -->
                <li>
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('images/logo-slider.png')}}" alt="slidebg1" data-bgfit="contain"
                         data-bgposition="center"
                         data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                </li>
            </ul>
        </div>
    </div>
    <!-- //Slider -->

    <div class="headernav">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="">
                        <i class="fa fa-home fa-2x home-icon"></i></a></div>
                <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                    <div class="dropdown">
                        <a data-toggle="dropdown" href="#">Category<b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a role="menuitem" tabindex="1" href="#">Borderlands 1</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="2" href="#">Borderlands 2</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="3" href="#">Borderlands 3</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                    <div class="wrap">
                        <form action="#" method="post" class="form">
                            <div class="pull-left txt"><input type="text" class="form-control"
                                                              placeholder="Search Topics"></div>
                            <div class="pull-right">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                    @if(Auth::check())
                        <div class="stnt pull-left">
                            <form action="03_new_topic.html" method="post" class="form">
                                <button class="btn btn-primary">Start New Topic</button>
                            </form>
                        </div>
                        <div class="env pull-left">
                            @if(Auth::check())
                                <a href="#" class="dropdown-toggle notification-bell" id="notification-icon"
                                   data-toggle="dropdown" role="button" data-display="static">
                                    <i class="fa fa-bell author-icon"></i>
                                    <input type="hidden" id="user_id" value="{{Auth::id()}}">
                                </a>

                                <ul class="dropdown-menu login-success notification" id="user_notification">

                                </ul>
                            @endif
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a role="menuitem" tabindex="-1" href="#">My Profile</a></li>
                                <li><a role="menuitem" tabindex="-2" href="#">Inbox</a></li>
                            </ul>
                        </div>
                        <div class="avatar pull-left dropdown">
                            <a data-toggle="dropdown" href="#"><img src="{{asset('images/avatar.png')}}" alt=""/><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->checkRole( 'admin'))
                                    <li><a href="{{route('admin.index')}}">Admin Panel</a></li>
                                @endif
                                <li><a href="{{route('user.index')}}">User Detail</a></li>
                                <li><a href="{{route('auth.logout')}}">Sign Out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="login-section">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               data-display="static">
                                <i class="fa fa-key fa-2x"></i></a>
                            <ul class="dropdown-menu">
                                <ul class="nav nav-tabs text-center" role="tablist">


                                    <li class="nav-item active">
                                        <a class="sign nav-link" data-toggle="tab" id="sign-in">sign in</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="sign nav-link" data-toggle="tab" id="sign-up">sign up</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="signin">
                                        <form method="post" action="{{route('auth.login')}}" id="loginForm">
                                            {{csrf_field()}}
                                            <div class="login-area">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    @if($errors->has('email'))
                                                        <div class="text-danger">
                                                            {{$errors->first('email')}}
                                                        </div>
                                                    @endif
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    @if($errors->has('password'))
                                                        <div class="text-danger">
                                                            {{$errors->first('password')}}
                                                        </div>
                                                    @endif
                                                    <input type="password" class="form-control"
                                                           name="password">
                                                </div>
                                            </div>
                                            <div class="form-submit">
                                                <button type="submit" class="btn btn-success btn-block">Sign in
                                                </button>
                                            </div>
                                        </form>
                                        <div class="login-social">
                                            <a href="{{route('login.social.provider', ['provider' => 'google'])}}"><i
                                                        class="fa fa-google"></i> Login
                                                with Google</a>
                                            <a href="{{route('login.social.provider', ['provider' => 'facebook'])}}"><i
                                                        class="fa fa-facebook-square"></i> Login
                                                with Facebook</a>
                                        </div>
                                    </div><!-- /#Sing in -->
                                    <div class="tab-pane" id="signup">
                                        <form method="post" action="{{route('auth.register')}}" id="registerForm">
                                            {{csrf_field()}}
                                            <div class="login-area">
                                                <div class=" form-group">
                                                    <label for="name">Full Name</label>
                                                    @if($errors->has('name'))
                                                        <div class="text-danger">
                                                            {{$errors->first('name')}}
                                                        </div>
                                                    @endif
                                                    <input type="text" class="form-control" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email Address</label>
                                                    @if($errors->has('email'))
                                                        <div class="text-danger">
                                                            {{$errors->first('email')}}
                                                        </div>
                                                    @endif
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    @if($errors->has('password'))
                                                        <div class="text-danger">
                                                            {{$errors->first('password')}}
                                                        </div>
                                                    @endif
                                                    <input type="password" class="form-control"
                                                           name="password" id="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation">Comfirm Password</label>
                                                    <input type="password" class="form-control"
                                                           name="password_confirmation">
                                                </div>

                                            </div>
                                            <div class="form-submit">
                                                <button type="submit" class="btn btn-success btn-block">Sign up
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row category-wrapper">
                <div class="category">
                    <ul class="list-group list-inline">
                        <div class="item-wrapper">
                            <a href="#"><li class="category-item">Trading</li></a>
                            <a href="#"><li class="category-item">Gaming</li></a>
                            <a href="#"><li class="category-item">Laravel</li></a>
                            <a href="#"><li class="category-item">Laravel</li></a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">

                    <!-- -->
                    <div class="sidebarblock">
                        <h3>Categories</h3>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <ul class="cats">
                                <li><a href="#">Trading for Money <span class="badge pull-right">20</span></a></li>
                                <li><a href="#">Vault Keys Giveway <span class="badge pull-right">10</span></a></li>
                                <li><a href="#">Misc Guns Locations <span class="badge pull-right">50</span></a></li>
                                <li><a href="#">Looking for Players <span class="badge pull-right">36</span></a></li>
                                <li><a href="#">Stupid Bugs &amp; Solves <span class="badge pull-right">41</span></a>
                                </li>
                                <li><a href="#">Video &amp; Audio Drivers <span class="badge pull-right">11</span></a>
                                </li>
                                <li><a href="#">2K Official Forums <span class="badge pull-right">5</span></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- -->
                    <div class="sidebarblock">
                        <h3>Poll of the Week</h3>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <p>Which game you are playing this week?</p>
                            <form action="#" method="post" class="form">
                                <table class="poll">
                                    <tr>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar color1" role="progressbar" aria-valuenow="40"
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                    Call of Duty Ghosts
                                                </div>
                                            </div>
                                        </td>
                                        <td class="chbox">
                                            <input id="opt1" type="radio" name="opt" value="1">
                                            <label for="opt1"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar color2" role="progressbar" aria-valuenow="40"
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 63%">
                                                    Titanfall
                                                </div>
                                            </div>
                                        </td>
                                        <td class="chbox">
                                            <input id="opt2" type="radio" name="opt" value="2" checked>
                                            <label for="opt2"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar color3" role="progressbar" aria-valuenow="40"
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                                    Battlefield 4
                                                </div>
                                            </div>
                                        </td>
                                        <td class="chbox">
                                            <input id="opt3" type="radio" name="opt" value="3">
                                            <label for="opt3"></label>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <p class="smal">Voting ends on 19th of October</p>
                        </div>
                    </div>

                    <!-- -->
                    <div class="sidebarblock">
                        <h3>My Active Threads</h3>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <a href="#">This Dock Turns Your iPhone Into a Bedside Lamp</a>
                        </div>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <a href="#">Who Wins in the Battle for Power on the Internet?</a>
                        </div>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <a href="#">Sony QX10: A Funky, Overpriced Lens Camera for Your Smartphone</a>
                        </div>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <a href="#">FedEx Simplifies Shipping for Small Businesses</a>
                        </div>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <a href="#">Loud and Brave: Saudi Women Set to Protest Driving Ban</a>
                        </div>
                    </div>


                </div>
                <div class="col-lg-8 col-md-8">
                    <!-- POST -->
                    <div class="post row">
                        <div class="wrap-ut col-md-8">
                            <div class="row">
                                <div class="userinfo col-md-2">
                                    <div class="avatar">
                                        <img src="{{asset('images/avatar.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="posttext col-md-10">
                                    <h2><a href="02_topic.html">10 Kids Unaware of Their Halloween Costume</a></h2>
                                    <p>It's one thing to subject yourself to a Halloween costume mishap because, hey,
                                        that's
                                        your prerogative.</p>
                                </div>
                            </div>
                            <div class="row">
                                <ul class="tags">
                                    <li class="badge">Gaming</li>
                                    <li class="badge">Studio</li>
                                    <li class="badge">Keyboard</li>
                                    <li class="badge">PHP</li>
                                    <li class="badge">Laravel</li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments">
                                <div class="commentbg">
                                    560
                                    <div class="mark"></div>
                                </div>

                            </div>
                            <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                            <div class="time"><i class="fa fa-clock-o"></i> 24 min</div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- POST -->


                    <div class="post row">
                        <div class="wrap-ut col-md-8">
                            <div class="row">
                                <div class="userinfo col-md-2">
                                    <div class="avatar">
                                        <img src="{{asset('images/avatar.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="posttext col-md-10">
                                    <h2><a href="02_topic.html">10 Kids Unaware of Their Halloween Costume</a></h2>
                                    <p>It's one thing to subject yourself to a Halloween costume mishap because, hey,
                                        that's
                                        your prerogative.</p>
                                </div>
                            </div>
                            <div class="row">
                                <ul class="tags">
                                    <li class="badge"><a href="#">Gaming</a></li>
                                    <li class="badge"><a>Gaming</a></li>
                                    <li class="badge"><a>Gaming</a></li>
                                    <li class="badge"><a>Gaming</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments">
                                <div class="commentbg">
                                    560
                                    <div class="mark"></div>
                                </div>

                            </div>
                            <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                            <div class="time"><i class="fa fa-clock-o"></i> 24 min</div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- POST -->

                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 logo "><a href="#"><img src="images/logo.jpg" alt=""/></a></div>
                <div class="col-lg-8 col-xs-9 col-sm-5 ">Copyrights 2014, websitename.com</div>
                <div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
                    <ul class="socialicons">
                        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-cloud"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
<script src="{{mix('/js/template.js')}}"></script>
<!-- END REVOLUTION SLIDER -->
</body>
</html>
