<div class="tp-banner-container">
    <div class="tp-banner"></div>
</div>
<!-- //Slider -->

<div class="headernav">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xs-3 col-sm-2 col-md-2 logo "><a href="{{route('post.index')}}">
                    <i class="fa fa-home fa-2x home-icon"></i></a></div>
            <div class="col-lg-6 search hidden-xs hidden-sm col-md-6">
                <div class="wrap">
                    <div class="pull-left txt">
                        <input type="text" class="form-control" id="keywordsPost"
                               placeholder="What do you need help with?">
                    </div>
                    <div class="pull-right">
                        <button class=" btn btn-info btn-lg" id="btnSearchPost"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-5 col-md-3 avt">
                @if(Auth::check())
                    <div class="stnt pull-left">
                        <a href="{{route("user.post.create")}}" class="btn btn-primary">Start New Topic</a>
                    </div>
                    <div class="env pull-left">
                        <a href="#" class="dropdown-toggle notification-bell" id="notification-icon"
                           data-toggle="dropdown" role="button" data-display="static">
                            <i class="fa fa-bell author-icon"></i>
                            <input type="hidden" id="user_id" value="{{Auth::id()}}">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right notification" id="user_notification">

                        </ul>
                    </div>
                    <div class="avatar pull-left dropdown">
                        <a data-toggle="dropdown" href="#" data-toggle="dropdown" role="button"
                           data-display="static"><img src="{{asset('images/avatar.png')}}" alt=""/><b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->checkRole( 'admin'))
                                <li><a href="{{route('admin.index')}}">Admin Panel</a></li>
                            @endif
                            <li><a href="{{route('user.index')}}">User Info</a></li>
                            <li><a href="{{route('auth.logout')}}">Sign Out</a></li>
                        </ul>
                    </div>
                    <div class="welcome">
                        Hi, {{Auth::user()->first_name}}
                    </div>
                @else
                    <div class="login-section">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           data-display="static">
                            <i class="fa fa-key fa-2x"></i> <b>Login/Sign Up</b></a>
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
