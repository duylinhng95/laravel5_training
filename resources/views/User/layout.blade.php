<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title')</title>
</head>
<body>
<header>
    &nbsp
</header>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 offset-md-3">
            <div class="card align-middle">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
