@extends('superadmin.layouts.app')
@section('stylesheets')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Thread</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('threads.update', $thread->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title"
                                    value="{{ $thread->title }}" required>
                            </div>
                            <div class="form-group">
                                <label> Description </label>
                                <textarea class="form-control"  id="summernote" placeholder="Enter the Description" name="description">{{ $thread->description }}</textarea>
                            </div>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer pt-0">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>

        </div>

        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection
@section('scripts')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#summernote').summernote()
    </script>
@endsection
