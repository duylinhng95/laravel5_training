@extends('Admin.layout')
@section('header')
    <h2 class="pageheader-title">Bad Words List </h2>
@endsection
@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary btn-search" id="searchWordsBtn"><i
                                    class="fa fa-search "></i></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload
                    files
                </button>

                <div class="modal" tabindex="-1" role="dialog" id="uploadModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{route('admin.post.words.upload')}}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-body">
                                    @if($errors->has('banned_words'))
                                        <div class="text-danger">
                                            <span>* </span>{{$errors->first('banned_words')}}
                                        </div>
                                    @endif
                                    <input name="banned_words" type="file" accept=".csv"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Upload Compelete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Words</th>
            </tr>
            </thead>
            <tbody>
            @foreach($words as $index => $word)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$word->context}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
