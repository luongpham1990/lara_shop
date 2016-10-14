@extends('admin.layouts.admin-app')
@section('title')
@endsection
<!-- Navigation --
    @section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Brand</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $pro)
                        <tr class="product{{$pro->id}}">
                            <td>{{$pro->id}}</td>
                            <td>{{$pro->product_name}}</td>
                            <td>{{$pro->price}}</td>
                            <td>{{$pro->description}}</td>
                            <td>{{$pro->view}}</td>
                            <td>{{$pro->brand}}</td>

                            <td><a href="/admin/product/edit/{{ $pro->id }}"
                                   class=" col-md-6 edit-modal btn btn-info">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>
                                <button class=" col-md-6 delete-modal btn btn-danger" onclick=""
                                        data-info="{{ $pro->id }}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>

                            <form id="product-{{ $pro->id }}" method="post"
                                  action="/admin/product/delete/{{ $pro->id }}">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>

                    </div>
                    <div class="modal-body">
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <button id="button-delete" type="button" class="btn actionBtn btn-danger"
                                    data-dismiss="modal">
                                <span id="footer_action_button" class='glyphicon'>Bạn có thực sự muốn xóa</span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });

    $(document).on('click', '.delete-modal', function () {
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        var id = $(this).data('info');
        console.log(id);

        $('#button-delete').attr('onclick', "document.getElementById('abc-" + id + "').submit()");
        $('#myModal').modal('show');
    });

    function fillmodalData(details) {
        $('#fid').val(details[0]);
        $('#title').val(details[1]);
        $('#image').val(details[2]);
        $('#author').val(details[3]);
        $('#content').val(details[4]);
        $('#category_id').val(details[5]);
    }

    $(document).on('click', '.delete-modal', function () {
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        var id = $(this).data('info');
        console.log(id);

        $('#button-delete').attr('onclick', "document.getElementById('product-" + id + "').submit()");
        $('#myModal').modal('show');
    });

</script>

@endpush