@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Edit Category</h1>
                <div class="panel panel-default">
                    <form method="POST" action="{{ route('categories.update',$category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" id="Title" placeholder="Enter Title" name="title" value="{{ $category->title }}">
                        </div>
                        @error('title')
                        <div class="col-12">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        <div class="form-group my-2">
                            <img src="{{ asset('uploads/categories/'.$category->image) }}" alt="" height="100px" width="100px">
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control" id="Image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="Image">Description</label>
                            <textarea class="form-control" id="Description" name="description">
                                {{ $category->description }}
                            </textarea>
                        </div>
                        @error('description')
                        <div class="col-12">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        <div class="form-group my-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
