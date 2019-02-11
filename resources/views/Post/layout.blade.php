<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: NeoLog ::</title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/vendor/user/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/font-awesome.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/offcanvas.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/user/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{mix('css/homepage.css')}}"/>
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
                @stack('left-sidebar')
                <!--========================== main-content ================================-->
                    @yield('content')
                @stack('right-sidebar')
                </div>
            </div><!-- Container -->
        </div><!-- Content-area -->
        @includeWhen(isset($post), 'Post.partial.footer')
    </div><!-- /Wrapper -->
    <script src="{{mix('/js/post.js')}}"></script>
    <script src="{{asset('js/vendor/user/custom.js')}}"></script>
</body>
</html>
