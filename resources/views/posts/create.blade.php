@extends('posts.master')
@section('content')
@section('title') | Create Post @endsection

<div class="row">
    <div class="col-xl-6 mx-auto">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> Create Post </h5>
                </div>

                <div class="card-body">
                    <div class="form-group my-3">
                        <label for="title"> Title </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" />
                    </div>

                    <div class="form-group my-3">
                        <label for="description"> Description </label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success"> Save </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection