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
    <a href="{{route('post.create')}}">Add new post</a>
    <table>
        <thead>
            <td>Title</td>
            <td>Description</td>
            <td>Content</td>
            <td>Action</td>
        </thead>
        @foreach($posts as $p)
        <tr>
            <td>{{$p->title}}</td>
            <td>{{$p->description}}</td>
            <td>{{$p->content}}</td>
            <td>
                <a href="{{url('/post/'.$p->id.'/edit')}}">Edit</a>
                <a href="{{url('/post/'.$p->id.'/delete')}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
