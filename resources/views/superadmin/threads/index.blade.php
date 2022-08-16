@extends('superadmin.layouts.app')
@section('stylesheets')
    <style>
        .thread-parent {
            position: relative;

        }

        .thread-child {
            display: none;
            position: absolute;
            width: 50%;
            top: 10%;
            left: 24%;
        }

        .card-inner{
            position: relative;
        }

        .fa-window-close{
            position: absolute;
            right: 5px;
            top: 5px;
            cursor: pointer;
        }
        .child{
            word-break: break-all;
        }
    </style>
@endsection
@section('content')
    <div class="container thread-parent">
        <table class="table" id="example1">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($threads as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('threads.edit', $item->id) }}" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i></a>
                            <a href="javascript:showBlockBox({{ $item->id }})" class="btn btn-warning btn-sm" style="z-index: 999"><i class="fas fa-exclamation-circle"></i></a>
                            <a href="{{ route('threads.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this')"><i class="fas fa-trash"></i></a>
                        </td>
                        <td>{{ $item->title }}</td>
                        <td class="text-truncate" style="word-break: break-all">
                            {!! $item->description !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card card-danger thread-child">
            <div class="card-inner">
                <div class="card-header">
                    <h3 class="card-title">Block Message</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('threads.block') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Enter Reason</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="blockmessage"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="" id="threadid" name="threadid">
                                </div>
                                <div class="form-group">
                                    <button class="form-control bg-danger">Block</button>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-window-close fa-1x	" onclick="hideBlockBox()"></i>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
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

        function showBlockBox(threadid){
            $('.thread-child').show();
            $('#threadid').val(threadid);
        }

        function hideBlockBox(){
            $('.thread-child').hide();
            $('#threadid').val("");
        }
    </script>
@endsection
