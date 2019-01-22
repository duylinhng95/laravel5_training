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
                        <button class="btn btn-success btn-show-edit-category">
                            <input type="hidden" name="categoryId" id="categoryId" value="{{$category->id}}">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-delete-category">
                            <input type="hidden" name="categoryId" id="categoryId" value="{{$category->id}}">
                            {{csrf_field()}}
                            Delete
                        </button>
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
