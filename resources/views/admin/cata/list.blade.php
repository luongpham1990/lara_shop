@extends('admin.layouts.admin-app')
@section('title')
    @endsection

           <!-- Navigation -->

       @section('content')
           <!-- Page Content -->
           <div id="page-wrapper">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-lg-12">
                           <h1 class="page-header">Category
                               <small>List</small>
                           </h1>
                       </div>
                       <!-- /.col-lg-12 -->
                       <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                           <thead>
                           <tr align="center">
                               <th>ID</th>
                               <th>Name</th>
                               <th>Category Parent</th>
                               <th>Status</th>
                               <th>Delete</th>
                               <th>Edit</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr class="odd gradeX" align="center">
                               <td>1</td>
                               <td>Tin Tức</td>
                               <td>None</td>
                               <td>Hiện</td>
                               <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                               <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                           </tr>
                           <tr class="even gradeC" align="center">
                               <td>2</td>
                               <td>Bóng Đá</td>
                               <td>Thể Thao</td>
                               <td>Ẩn</td>
                               <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                               <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                           </tr>
                           </tbody>
                       </table>
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
