@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create SubCategory</h1>
                <div class="panel panel-default">
                    <form method="POST" action="{{ route('subcategories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" id="Title" placeholder="Enter Title" name="title" required>
                        </div>
                        @error('title')
                        <div class="col-12">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="Title">Category</label>
                            <select class="form-control" name="category">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control" id="Image" name="image" required>
                        </div>
                        @error('image')
                        <div class="col-12">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="Image">Description</label>
                            <textarea class="form-control" id="Description" name="description" required>
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
