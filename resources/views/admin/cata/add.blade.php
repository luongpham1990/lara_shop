@extends('admin.layouts.app')
@section('htmlheader_title')
    Admin Profile
@endsection

      @section('main-content')

          <!-- Page Content -->
              <div id="page-wrapper">
                  {{--nếu tồn tại lỗi thì show--}}
                  @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert"
                                  aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <strong> {{ session('error') }}  </strong>
                      </div>
                  @endif
                  @if(session('alert'))
                      <div class="alert alert-info alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert"
                                  aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <strong> {{ session('alert') }}  </strong>
                      </div>
                  @endif

                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-lg-12">
                              <h1 class="page-header">Category
                                  <small>Add</small>
                              </h1>
                          </div>
                          <!-- /.col-lg-12 -->
                          {{--action, method--}}
                          <div class="col-lg-7" style="padding-bottom:120px">
                              <form action="/admin/cata/add" method="POST">
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                      <label>Category Name</label>
                                      <input class="form-control" name="name" placeholder="Please Enter Category Name" type="text" />
                                  </div>
                                  <button type="submit" class="btn btn-primary">Add Category</button>
                                  <button type="reset" class="btn btn-danger">Reset</button>
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
//    $(document).ready(function () {
//        $('#dataTables-example').DataTable({
//            responsive: true
//        });
//    });
//
//    $(document).on('click', '.delete-modal', function () {
//        $('.modal-title').text('Delete');
//        $('.deleteContent').show();
//        var id = $(this).data('info');
//        console.log(id);
//
//        $('#button-delete').attr('onclick', "document.getElementById('abc-" + id + "').submit()");
//        $('#myModal').modal('show');
//    });
//
//    function fillmodalData(details) {
//        $('#fid').val(details[0]);
//        $('#title').val(details[1]);
//        $('#image').val(details[2]);
//        $('#author').val(details[3]);
//        $('#content').val(details[4]);
//        $('#category_id').val(details[5]);
//    }
//
//    $(document).on('click', '.delete-modal', function () {
//        $('.modal-title').text('Delete');
//        $('.deleteContent').show();
//        var id = $(this).data('info');
//        console.log(id);
//
//        $('#button-delete').attr('onclick', "document.getElementById('product-" + id + "').submit()");
//        $('#myModal').modal('show');
//    });

</script>

@endpush
