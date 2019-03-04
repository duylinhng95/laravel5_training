<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neolog</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/vendor/user/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{mix('css/template.css')}}"/>
    {{--FONTS--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,800" rel="stylesheet">
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
    @include('Post.partial.header')

    <section class="content">
        {{--Navigation Button--}}
        <div class="container">
            <div class="row category-wrapper">
                <div class="navigation-bar">
                    <ul class="list-group list-inline">
                        <div class="item-wrapper">
                            <a href="{{route('post.index')}}">
                                <li class="navigation-item">Newest</li>
                            </a>
                            <a href="#">
                                <li class="navigation-item">Browse</li>
                            </a>
                            @if(Auth::check())
                                <a href="#">
                                    <li class="navigation-item">Follows</li>
                                </a>
                            @endif
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        {{--End Navigation Button--}}
        {{--Main Content--}}
        <div class="container">
            <div class="row">
                {{--Left sidebar--}}
                {{--List post--}}
                @yield('content')

            </div>
        </div>
    </section>

    @include('Post.partial.footer')
</div>
<!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
<script src="{{mix('/js/post.js')}}"></script>
<script src="{{mix('/js/template.js')}}"></script>
<!-- END REVOLUTION SLIDER -->
</body>
</html>
