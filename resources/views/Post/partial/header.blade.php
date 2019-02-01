<header>
    <!--========================== Header-Top ================================-->
    <div class="header-top">
        <div class="container">
            <div class="col-md-9 col-sm-7 xs-view">
                <a href="{{route('post.index')}}"><img class="logo" src="images/logo.png" alt="Logo"/></a>
            </div>
            <div class="col-md-3 col-sm-5 xs-view-right">
            @yield('search')
            <!-- Author -->
                <div class="author-form">
                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle author-icon" data-toggle="dropdown" role="button"
                           data-display="static">
                            <i class="fa fa-user author-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::check())
                            <div class="row">
                                <li class="col-md-6">
                                    <a class="sign" href="{{route('auth.logout')}}">sign out</a>
                                </li>
                                <li class="col-md-6">
                                    <a class="sign" href="{{route('user.index')}}">user detail</a>
                                </li>
                            </div>
                            <!-- Nav tabs -->

                            @else
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
                                    @if(session('code'))
                                        <div class="alert alert-danger">
                                            <div class="col-md-6">
                                                {{session('message')}}
                                            </div>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('auth.login')}}">
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
                                            <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                        </div>
                                    </form>
                                </div><!-- /#Sing in -->
                                <div class="tab-pane" id="signup">
                                    @if(isset($status))
                                        <div class="alert alert-danger">{{$code}} {{$message}}</div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('auth.register')}}">
                                        {{csrf_field()}}
                                        <div class="login-area">
                                            <div class=" form-group">
                                                <label for="name">Full Name</label>
                                                @if($errors->has('name'))
                                                    <div class="text-danger">
                                                        {{$errors->first('name')}}
                                                    </div>
                                                @endif
                                                <input type="email" class="form-control" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email Address</label>
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
                                                       name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Comfirm Password</label>
                                                <input type="password" class="form-control"
                                                       name="password_confirmation">
                                            </div>

                                        </div>
                                        <div class="form-submit">
                                            <button type="submit" class="btn btn-success btn-block">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </ul>
                    </li>
                </div><!-- /#Sing up -->
            </div><!-- /Tab-Content -->
            </ul><!-- /Dropdown-menu -->
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
                <!--toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="{{route('post.index')}}">home</a></li>
                        <li><a href="about.html">about</a></li>
                        <li><a href="contact.html">contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-->
        </nav>
    </div><!-- Header-Nav -->
</header>
