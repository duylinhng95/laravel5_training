@extends('Post.layout')
@section('content')
    <div class="col-md-6 col-xs-12 col-sm-12 col-md-offset-3">
        <div class="main-content">
            <article>
                <h4 class="page-title">about me</h4>
                <a href="#"><img class="img-responsive" src="{{asset('images/author.png')}}" alt="Post"></a>
                <div class="post-content">
                    <p class="post">Things often come full circle in software engineering. The web in particular started with servers delivering content down to the client. Recently with the creation of modern web frameworks such as Angular JS and Ember, we've seen a push to render on the client and only use a server for an API</p>
                    <p class="post">We're now seeing a possible return or, rather, more of a combination of both architectures happening</p>
                    <p class="post">Lorem ipsum dolor sit amet, consectetur adipisicing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam, quis nostrud exercitation ullamco blboris nisi ut aliquip ex ea commodo consequat.</p>
                    <blockquote>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                    </blockquote>
                    <p class="post">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p class="post">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.</p>
                </div>
            </article>
        </div><!-- main-content -->
    </div>
@endsection
