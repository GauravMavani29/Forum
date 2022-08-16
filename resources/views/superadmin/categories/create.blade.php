@extends('superadmin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title"
                                    required>
                            </div>
                            @error('title')
                                <div class="col-12">
                                    <div class="alert alert-danger">{{ $message }}</div>
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Image" name="image"
                                            required>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <div class="col-12">
                                    <div class="alert alert-danger">{{ $message }}</div>
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea class="form-control" id="Description" name="description" required>
                            </textarea>
                            </div>
                            @error('description')
                                <div class="col-12">
                                    <div class="alert alert-danger">{{ $message }}</div>
                                </div>
                            @enderror
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
    </div><!-- /.container-fluid -->
@endsection
