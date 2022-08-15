@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center d-flex flex-column">
            @foreach ($categories as $item)
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                    CRUD 1({{ $item->title }})
                    </div>
                    <ul class="list-group">
                        @foreach ($item->subcategories as $subcategory)
                        <div class="d-flex">
                            <img src="{{ asset('uploads/subcategories/' . $subcategory->image) }}" class="img-responsive m-2" alt="" height="50px" width="50px">
                            <div>
                                <a href="{{ route('subcategory.thread',$subcategory->title) }}" class="m-2">CRUD2 </a>
                                <p>{{ $subcategory->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
