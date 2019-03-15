@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Dashboard</h2>
@endsection
@section('content')
    <div class="card-header">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
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
                            # Comment in days
                        </div>
                        <div class="card-body">
                            <h1>{{$commentsInDay}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            # User register in days
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
        </div>
    </div>
@endsection
