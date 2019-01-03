<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
</head>
<body>
<form action="{{url('post/' . $post->id)}}" method="post">
    @method('PUT')
    {{csrf_field()}}
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="{{$post->title}}" value="{{$post->title}}">

    <label for="description">Description</label>
    <input type="text" name="description" placeholder="{{$post->title}}" value="{{$post->title}}">

    <label for="title">Content</label>
    <textarea name="content" id="" cols="30" rows="10" placeholder="{{$post->title}}">{{$post->title}}</textarea>

    <button type="submit">Submit</button>
</form>
</body>
</html>
