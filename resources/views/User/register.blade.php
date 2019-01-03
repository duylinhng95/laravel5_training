<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
</head>
<body>
    <form action="{{url('/user/register')}}" method="post">
        {{csrf_field()}}
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="name">Email</label>
        <input type="email" name="email">
        <label for="name">Password</label>
        <input type="password" name="password">

        <button type="submit">Register</button>
    </form>
</body>
</html>
