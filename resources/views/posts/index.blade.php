@extends('posts.master')
@section('content')
@section('title') | Posts Listing @endsection

<div class="row">
    <div class="col-xl-12 text-end">
        <a href="{{ route('posts.create') }}" class="btn btn-primary"> Create Post </a>
    </div>
</div>

<div class="card my-3">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th width="20%">Title</th>
                <th width="50%">Description</th>
                <th width="20%">Action</th>
            <tr>
        </thead>

        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            <a href="{{ route('posts.show', $post->id) }}" title="View" class="btn btn-sm btn-info">
                                View
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" title="Edit" class="btn btn-sm btn-success">
                                Edit </a>

                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?');" title="Delete" class="btn btn-sm btn-danger"> Delete </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p class="text-danger text-center fw-bold"> No post found! </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection