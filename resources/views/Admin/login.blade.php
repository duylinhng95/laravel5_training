<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login NeoLog</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{mix('css/admin.css')}}">
</head>

<body>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><a href="{{route('post.index')}}"><img class="logo-img" src="{{asset('images/logo.png')}}" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            <form action="{{route('admin.login')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control form-control-lg" name="email" type="text" placeholder="Username" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="{{mix('js/admin.js')}}"></script>
</body>

</html>