<header>
    <!--========================== Header-Top ================================-->
    <div class="header-top">
        <div class="container">
            <div class="col-md-9 col-sm-7 xs-view">
                <a href="{{route('post.index')}}"><img class="logo" src="{{asset('images/logo.png')}}" alt="Logo"/></a>
                <ul class="list-inline nav-header">
                    <li><a href="{{route('post.index')}}">home</a></li>
                    @if(Auth::check())
                    <li><a href="{{route('user.list')}}">user</a></li>
                    @endif
                    <li><a href="#">about</a></li>
                </ul>
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
                            <div class="row text-center">
                                <li>
                                    <a class="sign" href="{{route('auth.logout')}}">sign out</a>
                                </li>
                                <li>
                                    <a class="sign" href="{{route('user.index')}}">user detail</a>
                                </li>
                                <li>
                                    <a class="btn btn-warning text-uppercase" href="{{route('user.post.create')}}">Add new Post</a>
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

</header>
