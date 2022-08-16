@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex flex-column">
            @foreach ($categories as $item)
                <div class="card col-12 col-md-2 col-sm-12" style="width: 100%">
                    <div class="card-header">
                        CRUD 1({{ $item->title }})
                    </div>
                    <ul class="list-group">
                        @foreach ($item->subcategories as $subcategory)
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img src="{{ asset('uploads/subcategories/' . $subcategory->image) }}"
                                        class="img-responsive m-2" alt="" height="50px" width="50px">
                                    <div class="m-2">
                                        <a href="{{ route('subcategory.thread', $subcategory->title) }}"
                                            class="text-decoration-none text-primary">CRUD2 </a>
                                        <p>{{ $subcategory->description }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    @if ($subcategory->threads->last())
                                        <div>
                                            <p class="m-1">Threads</p>
                                            <p class="text-center">{{ count($subcategory->threads) }}</p>
                                        </div>
                                        <img src="{{ asset  ('/uploads/avatar/defaultavatar.webp') }}"
                                            class="img-responsive m-2" alt="" height="50px" width="50px">
                                        <div>
                                            <p class="m-1">{{ Str::limit($subcategory->threads->last()->title, 15) }}
                                            </p>
                                            <p class="text-center">
                                                {!! date('d-M-y', strtotime($subcategory->threads->last()->created_at)) !!}
                                                {{ $subcategory->threads->last()->user->name }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
