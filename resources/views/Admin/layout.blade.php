<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NeoLog</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{mix('css/admin.css')}}">
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="{{route('admin.index')}}">NeoLog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 offset-3">
                                        <a href="{{route('admin.password')}}" class="connection-item"><i class="fa fa-user-lock fa-3x" ></i><span>Password</span></a>
                                        <a href="{{route('auth.logout')}}" class="connection-item"><i class="fa fa-key fa-3x"></i><span>Sign Out</span></a>
                                        <a href="{{route('post.index')}}" class="connection-item"><i class="fa fa-arrow-circle-left fa-3x"></i><span>Back to Homepage</span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            User
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/')}}"><i class="fas fa-fw fa-user"></i>Users list</a>
                        </li>
                        <li class="nav-divider">
                            Post
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/post')}}"><i class="fas fa-fw fa-sticky-note"></i>Posts list</a>
                            <a class="nav-link" href="{{url('/admin/post/words')}}"><i class="fas fa-fw fa-sticky-note"></i>Posts Banned Words</a>
                        </li>
                        <li class="nav-divider">
                            Category
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/category')}}"><i class="fas fa-fw fa-database"></i>Categories list</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        @yield('header')
                    </div>
                </div>
            </div>

            {{--Content--}}
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="{{mix('js/admin.js')}}"></script>

@stack('script')
</body>

</html>
