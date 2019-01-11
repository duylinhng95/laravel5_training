@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">List Category </h2>
@endsection
@section('content')
    <div class="card-header">
        <h2>Categories list</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Add
            Category
        </button>
        @include('Admin.category.modal')
    </div>
    <div class="card-body table-reponsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $index => $category)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <button onclick="editCategory({{$category->id}})" class="btn btn-success">Edit</button>
                        <button onclick="deleteCategory({{$category->id}})" class="btn btn-warning">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('script')
    <script src="{{mix('js/category.js')}}"></script>
@endpush
