@extends('superadmin.layouts.app')

@section('content')
    <div class="container">
        <table class="table" id="example1">
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
@section('scripts')
    <script>
        $(function() {
            // $("#example1").DataTable({
            //     "responsive": true,
            //     "lengthChange": false,
            //     "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
