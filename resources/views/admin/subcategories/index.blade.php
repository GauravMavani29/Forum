@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">SubCategory</h2>
        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">New SubCategory</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $item)
                    <tr>
                        <td>
                            <a href="{{ route('subcategories.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('subcategories.destroy', $item->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this')">Delete</a>
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category->title }}</td>
                        <td><img src="{{ asset('uploads/subcategories/' . $item->image) }}" alt="" height="100px"
                                width="100px"></td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
