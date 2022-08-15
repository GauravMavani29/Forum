@extends('posts.master')
@section('content')
@section('title') | Update Post @endsection

<div class="row">
    <div class="col-xl-6 mx-auto">
        <form action="{{ route('posts.update', $post->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> Update Post </h5>
                </div>

                <div class="card-body">
                    <div class="form-group my-3">
                        <label for="title"> Title </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ $post ? $post->title : '' }}" />
                    </div>

                    <div class="form-group my-3">
                        <label for="description"> Description </label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description">{{ $post ? $post->description : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success"> Update </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection