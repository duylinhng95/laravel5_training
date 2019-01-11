<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/post.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
<header>
    &nbsp
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{mix('js/app.js')}}"></script>
<script src="{{mix('js/post.js')}}"></script>
@stack('script')
</html>
