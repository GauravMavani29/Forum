@extends('layouts.app')
@section('stylesheets')
    <link href="{{ asset('css/threads.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid mt-100">
        <div class="d-flex flex-wrap justify-content-between">
            <div>
                <a href="{{ route('thread.create', $subcategory) }}"type="button" class="btn btn-shadow btn-wide btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    New thread
                </a>
            </div>
            <div class="col-12 col-md-3 p-0 mb-3">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header pl-0 pr-0">
                <div class="row no-gutters w-100 align-items-center">
                    <div class="col ml-3">Topics</div>
                    <div class="col-4 text-muted">
                        <div class="row no-gutters align-items-center">
                            <div class="col-4">Replies</div>
                            <div class="col-8">Last update</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                @foreach ($threads as $item)
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <a href="{{ route('thread.show',$item->slug) }}" class="text-big" data-abc="true">{{ $item->title }}</a>
                            <div class="text-muted small mt-1">{!! date('d-M-y', strtotime($item->created_at)) !!} &nbsp;&middot;&nbsp; <a
                                    href="javascript:void(0)" class="text-muted" data-abc="true">{{ $item->user->name }}</a>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-4">
                            <div class="row no-gutters align-items-center">
                                <div class="col-4">{{ count($item->replies) }}</div>
                                <div class="media col-8 align-items-center">
                                    <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg"
                                        alt="" class="d-block ui-w-30 rounded-circle">
                                    <div class="media-body flex-truncate ml-2">
                                        <div class="line-height-1 text-truncate">1 day ago</div>
                                        <a href="javascript:void(0)" class="text-muted small text-truncate"
                                            data-abc="true">by
                                            Tim cook</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr class="m-0">
        </div>
        <nav>
            {{ $threads->links('pagination::bootstrap-4') }}
        </nav>
    </div>



@endsection
