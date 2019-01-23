<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neologs</title>
    <link href="{{mix('css/post.css')}}" rel="stylesheet">
</head>

<body>
<div class="container-fluid featured-area-white-border">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box border-right-1">
                    <a href="{{route('auth.logout')}}">
                        <i class="fa fa-key"></i> Logout</a>
                </div>
                <div class="login-box border-left-1 border-right-1">
                    <a href="{{route('user.index')}}">
                        <i class="fa fa-user"></i> User</a>
                </div>
                @if(\Auth::user()->checkRole(2))
                <div class="login-box border-left-1 border-right-1">
                    <a href="{{route('admin.index')}}">
                        <i class="fa fa-lock"></i> Admin</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- LOGO -->
<div class="container">
    <div class="row">
        <div class="header">
            <div class="logo">
                <img src="{{asset('images/logo.png')}}" alt="logo">
            </div>
        </div>
    </div>
</div>
<!-- END LOGO-->
<!-- TOP NAVIGATION -->
<div class="container-fluid">
    <div class="navigation">
        <div class="row">
            <ul class="topnav">
                <li></li>
                <li>
                    <a href="{{route('post.index')}}">
                        <i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{route('category.index')}}">
                        <i class="fa fa-book"></i> Category</a>
                </li>
                <li>
                    <a href="{{route('user.list')}}">
                        <i class="fa fa-users"></i> Users</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END TOP NAVIGATION -->
@yield('search')
<!-- MAIN SECTION -->
<div class="container featured-area-default padding-30">
    @yield('content')
</div>
<!-- END MAIN SECTION -->

<!-- COPYRIGHT INFO -->
<div class="container-fluid footer-copyright marg30">
    <div class="container">
        <div class="float-left">
            Copyright © 2018 Sunny Gohil</a>
        </div>
        <div class="float-right">
            <i class="fa fa-facebook"></i> &nbsp;
            <i class="fa fa-twitter"></i> &nbsp;
            <i class="fa fa-linkedin"></i>
        </div>
    </div>
</div>
<!-- END COPYRIGHT INFO -->

<!-- LOADING MAIN JAVASCRIPT -->
@stack('script')
<script src="{{mix('/js/post.js')}}"></script>
</body>

</html>
