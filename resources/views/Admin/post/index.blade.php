@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Post </h2>
@endsection
@section('content')
    <div class="card-header">
        Posts list
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $p)
                <tr>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
