<header>
    <!--========================== Header-Top ================================-->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-7 xs-view">
                    <a href="{{route('post.index')}}"><img class="logo" src="{{asset('images/logo.png')}}" alt="Logo"/></a>
                    <ul class="list-inline nav-header">
                        <li><a href="{{route('post.index')}}">home</a></li>
                        <li><a href="{{route('about')}}">about</a></li>
                        @if(Auth::check())
                            <li><a href="{{route('user.list')}}">user</a></li>
                            <li><a class="btn btn-warning text-uppercase btn-xs" href="{{route('user.post.create')}}">Add
                                    new Post</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4 col-sm-5 xs-view-right">
                @yield('search')
                <!-- Author -->

                </div><!-- /Tab-Content -->
                <div class="col-md-2">
                    <div class="author-form">
                        @if(Auth::check())
                            <li class="dropdown pull-left">
                                <a href="#" class="dropdown-toggle author-icon notification-bell" id="notification-icon" data-toggle="dropdown" role="button" data-display="static">
                                    <i class="fa fa-bell author-icon"></i>
                                    <input type="hidden" id="user_id" value="{{Auth::id()}}">
                                </a>

                                <ul class="dropdown-menu login-success notification" id="user_notification">

                                </ul>
                            </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle author-icon" data-toggle="dropdown" role="button"
                               data-display="static">
                                @if(Auth::check())
                                    <i class="fa fa-user author-icon"></i>
                                @else
                                    <i class="fa fa-key author-icon"></i>
                                @endif
                            </a>
                            @if(Auth::check())
                                <ul class="dropdown-menu login-success">

                                    <div class="row text-center">
                                        @if(Auth::user()->checkRole( 'admin'))
                                            <li class="row">
                                                <div class="col-md-12 text-left">
                                                    <a class="sign" href="{{route('admin.index')}}"><i class="fas fa-lock icon"></i> Admin
                                                        Panel</a>
                                                </div>
                                            </li>
                                        @endif
                                        <li class="row">
                                            <div class="col-md-12 text-left">
                                                <a class="sign" href="{{route('user.index')}}">
                                                    <i class="fas fa-home icon"></i>user detail</a>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-md-12 text-left">
                                                <a class="sign" href="{{route('auth.logout')}}">
                                                    <i class="fas fa-key icon"></i>sign out</a>
                                            </div>
                                        </li>
                                    </div>
                                    <!-- Nav tabs -->
                                </ul>

                            @else
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
                                            @if(session('code'))
                                                <div class="alert alert-danger">
                                                    {{session('message')}}
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
                            @endif
                        </li>
                    </div><!-- /#Sing up -->
                </div>
            </div>
        </div><!-- /Author -->
    </div>

</header>
