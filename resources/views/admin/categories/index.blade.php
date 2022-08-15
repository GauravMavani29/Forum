@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Category</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">New Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>
                            <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('categories.destroy', $item->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this')">Delete</a>
                        </td>
                        <td>{{ $item->title }}</td>
                        <td><img src="{{ asset('uploads/categories/' . $item->image) }}" alt="" height="100px"
                                width="100px"></td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
