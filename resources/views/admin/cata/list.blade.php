@extends('admin.layouts.admin-app')
@section('title')
    @endsection

           <!-- Navigation -->

       @section('content')
           <!-- Page Content -->
           <div id="page-wrapper">

               @if(session('thongbao'))
                   <div class="alert alert-success">
                       {{session('thongbao')}}
                   </div>
               @endif

               @if(count($errors)>0)

                   <div class="alert alert-danger fade in">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close"
                          title="close">×</a>
                       @foreach($errors->all() as $error)

                           <p><strong>{{ $error }}!</strong></p>
                       @endforeach
                   </div>

               @endif

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
                               <th>Actions</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($cata as $ct)
                               <tr class="odd gradeX" align="center">
                                   <td>{{$ct->catalog_id  }}</td>
                                   <td>{{$ct->catalog_name}}</td>

                                   <td><a href="{{url('/admin/cata/edit/'.$ct->catalog_id)}}" class="edit-modal btn btn-info">
                                           <span class="glyphicon glyphicon-edit"></span> Edit
                                       </a>

                                       <button class="delete-modal btn btn-danger" onclick="" data-info="{{ $ct->catalog_id }}">
                                           <span class="glyphicon glyphicon-trash"></span> Delete
                                       </button>
                                   </td>
                                   <form id="abc-{{ $ct->catalog_id }}" method="post"
                                         action="/admin/cata/delete/{{ $ct->catalog_id }}">
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

</script>

@endpush
