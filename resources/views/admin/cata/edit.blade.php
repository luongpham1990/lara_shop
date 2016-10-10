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
                                    <small>Edit</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">
                                <form method="POST" action="/admin/cata/{{$cata->catalog_id}}/edit/" enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal"><input name="_token" type="hidden" value="fPdMAGRbTI5JL8qhYatebA965h6NuPPpAImtmrJk">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{$cata->catalog_name}}"/>
                                    </div>

                                    <button type="submit" class="btn btn-default">Category Edit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
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
