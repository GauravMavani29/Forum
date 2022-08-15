@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Edit SubCategory</h1>
                <div class="panel panel-default">
                    <form method="POST" action="{{ route('subcategories.update',$subcategory->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" id="Title" placeholder="Enter Title" name="title" value="{{ $subcategory->title }}" required>
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
                                    <option value="{{ $item->id }}" @selected($subcategory->category_id == $item->id)>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <img src="{{ asset('uploads/subcategories/'.$subcategory->image) }}" alt="" height="100px" width="100px">
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control" id="Image" name="image">
                        </div>
                        @error('image')
                        <div class="col-12">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="Image">Description</label>
                            <textarea class="form-control" id="Description" name="description" required>
                                {{ $subcategory->description }}
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
