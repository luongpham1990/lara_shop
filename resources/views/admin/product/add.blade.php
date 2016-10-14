@extends('admin.layouts.admin-app')
@section('title')
    @endsection

       @section('content')



           <!-- Page Content -->
               <div id="page-wrapper">
                   <div class="container-fluid">
                       @if(count($errors)>0)

                           <div class="alert alert-danger fade in">

                               <a href="#" class="close" data-dismiss="alert" aria-label="close"
                                  title="close">×</a>
                               @foreach($errors->all() as $error)
                                   <p><strong>{{ $error }}!</strong></p>
                               @endforeach
                           </div>

                       @endif
                       <div class="row">
                           <div class="col-lg-12">
                               <h1 class="page-header">Product
                                   <small>Add</small>
                               </h1>
                           </div>
                           <!-- /.col-lg-12 -->
                           <div class="col-lg-6" style="padding-bottom:120px">
                               <form action="/admin/product/add" method="POST">
                                   {{ csrf_field() }}

                                   <div class="form-group">
                                       <label>Name</label>
                                       <input class="form-control" name="name" id="name" placeholder="Please Enter Productname" />
                                   </div>
                                   <div class="form-group">
                                       <label>Price</label>
                                       <input class="form-control" name="price" id="price" placeholder="Please Enter Price" />
                                   </div>
                                   <div class="form-group">
                                       <label>Product Description</label>
                                       <textarea class="form-control" name="description" id="description" rows="10" name="txtContent"></textarea>
                                   </div>
                                   <div class="form-group">
                                       <label>Product Brand</label>
                                           <select id="catalog" class="form-control input-lg" name="catalog">
                                               <option value="0">Catalogs </option>
                                               <option value="Quần">Quần </option>
                                               <option value="Áo">Áo </option>

                                           </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Product Status</label>
                                       <label class="radio-inline"id="productstatus">
                                           <input name="rdoStatus" value="1" checked="" type="radio">Visible
                                       </label>
                                       <label class="radio-inline">
                                           <input name="rdoStatus" value="2" type="radio">Invisible
                                       </label>
                                   </div>
                                   {{--<div class="form-group">--}}
                                       {{--<label>Featured image</label>--}}
                                       {{--<div class="fileupload fileupload-new" data-provides="fileupload">--}}
                                                 {{--<input name="image" type="file">--}}
                                           {{--<div class="fileupload-preview">--}}
                                               {{--<img src="" alt="" id="blah" class="img-responsive">--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}

                                   {{--<div class="col-md-1"></div>--}}
                                   {{--<div class="col-md-4">--}}
                                       {{--@for($i=1; $i<=3; $i++)--}}
                                       {{--<div class="form-group">--}}
                                           {{--<label>Thumbnail Product Photo</label>--}}
                                           {{--<input type="file" name="thumbnailproductphoto"/>--}}
                                       {{--</div>--}}
                                           {{--@endfor--}}
                                   {{--</div>--}}

                                   <button type="submit" class="btn btn-default">Add Product</button>
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