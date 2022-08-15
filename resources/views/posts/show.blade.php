@extends('posts.master')
@section('content')
@section('title') | Show Post @endsection

<div class="row">
    <div class="col-xl-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Show Post </h5>
            </div>

            <div class="card-body">
                <div class="form-group my-3">
                    <label for="title"> Title </label>
                    <input type="text" name="title" id="title" readonly disabled class="form-control"
                        value="{{ $post ? $post->title : '' }}" />
                </div>

                <div class="form-group my-3">
                    <label for="description"> Description </label>
                    <textarea name="description" id="description" readonly disabled class="form-control"
                        placeholder="Description">{{ $post->description }}</textarea>
                </div>

                <div class="form-group">
                    <a href="{{ route('posts.index') }}" class="btn btn-success"> Back </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection