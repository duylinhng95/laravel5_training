@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Dashboard</h2>
@endsection
@section('content')
    <div class="card-body">
        <div class="container">
            <div class="row total-numbers">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3># Posts in days</h3>
                        </div>
                        <div class="card-body">
                            <h1>{{$postInDay}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3># Comment in days</h3>
                        </div>
                        <div class="card-body">
                            <h1>{{$commentsInDay}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3># User register in days</h3>
                        </div>
                        <div class="card-body">
                            <h1>{{$registerInDay}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Post analytics by day</h3>
                        </div>
                        <div class="card-body">
                            <div id="postDayChart" class="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Register analytics by day</h3>
                        </div>
                        <div class="card-body">
                            <div id="registerDayChart" class="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row top-comment">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Top Most Comments</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 60%">Title</th>
                                    <th style="width: 10%"># Comments</th>
                                    <th style="width: 30%">Author</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mostComments as $post)
                                    <tr>
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->count_comments}}</td>
                                        <td>{{$post->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row top-like">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Top Most Liked</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 60%">Title</th>
                                    <th style="width: 10%"># Likes</th>
                                    <th style="width: 30%">Author</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mostLikes as $post)
                                    <tr>
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->count_votes}}</td>
                                        <td>{{$post->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row top-like">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Top Most Viewed</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 60%">Title</th>
                                    <th style="width: 10%"># Viewed</th>
                                    <th style="width: 30%">Author</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mostViews as $post)
                                    <tr>
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->view}}</td>
                                        <td>{{$post->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
