@extends('admin.layouts.admin-app')
@section('title')
@endsection
@push('link')
<style>
    .center a{
        color: #FFFFFF;
    }
    table.dataTable thead .sorting {
        background: none;
    }
    table.dataTable thead .sorting_asc{
        background: none;
    }
</style>
@endpush

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->id}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->username}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->email}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->address}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->phone}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name"> @if ($user->confirmed == 1)
                                            {{ 'active' }}
                                        @else
                                            {{ "No Active" }}

                                        @endif</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit User Name">{{$user->created_at}}</a>
                                </td>
                                {{--<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>--}}
                                {{--<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>--}}
                            </tr>
                            </tbody>
                        </table>


                    </form>
                </div>
            </div>
            <!-- /.row -->
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

