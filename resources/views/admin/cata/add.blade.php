@extends('admin.layouts.app')
@section('htmlheader_title','Add Categories')

@section('contentheader_title','Category')
@section('contentheader_description','Thêm mới Category')
@section('main-content')


    <!-- Page Content -->
    <section class="content paddingleft_right15">
        <div class="row">

            <!-- /.col-lg-12 -->

                <form action="/admin/cata/add" method="POST">
                    {{ csrf_field() }}
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
                    <div class="panel panel-primary ">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                                       data-c="#fff" data-hc="white" id="livicon-47"
                                                       style="width: 16px; height: 16px;">
                                </i>
                                Thêm mới Categories
                            </h4>
                        </div>
                        <br>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Category Name"
                                       type="text"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
            </div>

        <!-- /.row -->
    </section>
@endsection
>>>>>>> 3b7b0f621bcaa71b343a8e3df4e6cd3137ae3f71

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
