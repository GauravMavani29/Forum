@extends('layouts.app')
@section('stylesheets')
    {{-- <link href="{{ asset('ckeditor/contents.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <form action="{{ route('thread.store',$subcategory) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title"> Post Thread </h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label> Title </label>
                                <input type="text" class="form-control" name="title" placeholder="Enter the Title">
                            </div>
                            <div class="form-group" >
                                <label> Description </label>
                                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'description' );
</script>
@endsection
