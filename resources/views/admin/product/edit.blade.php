@extends('admin.layouts.admin-app')
@section('title')
@endsection
@push('link')
<style>
    .center a {
        color: #FFFFFF;
    }

    table.dataTable thead .sorting {
        background: none;
    }

    table.dataTable thead .sorting_asc {
        background: none;
    }

    .icon_del {
        position: relative;
        top: -230px;
        left: 130px;
    }
</style>
@endpush

<div id="wrapper">

    <!-- Navigation -->

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
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-6" style="padding-bottom:120px">
                        <form method="POST" action="/admin/product/{{$pro->id}}/edit" method="POST"
                              enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Please Enter Productname"
                                       value="{{$pro->product_name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" id="price" placeholder="Please Enter Price"
                                       value="{{$pro->price}}"/>
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5"
                                          name="txtContent">{{$pro->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Product Catalog</label>
                                <select id="catalog" class="form-control input-lg" name="catalog">
                                    @foreach($cata as $ct)
                                        <option value="{{$ct->catalog_id}}">{{$ct->catalog_name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Brand</label>
                                <input id="brand" class="form-control input-lg" name="brand" value="{{$pro->brand}}"
                                       placeholder="Please Enter Brand">
                            </div>

                            <div class="form-group">
                                <label>Product Status</label>
                                <label class="radio-inline" id="productstatus">
                                    <input name="rdoStatus" value="1" checked="" type="radio">Visible
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="2" type="radio">Invisible
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Edit Product</button>
                            <button type="reset" class="btn btn-danger">Reset</button>

                            <div class="fileupload-preview img-responsive" id="image-holder"></div>


                        </form>
                    </div>
                    <form id="product-{{ $pro->id }}" method="get"
                          action="/admin/product/{{$img_detail->id}}/delimg">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <strong> Image details: </strong><br/><br/>
                        @foreach($img_detail as $product_photo_id => $img_detail)
                            <div class="form-group col-lg-2" id="hinh{{$product_photo_id}}">
                                <img class="img-responsive" src="/images/{{$img_detail}}">
                                <a id="del_img" class="btn btn-danger btn-circle icon_del" data-info="{{ $pro->id }}">
                                    <i class="fa fa-times"></i></a>
                                <input type="file" name="image">
                            </div>
                            {{--<button> Edit Image</button>--}}
                        @endforeach
                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
                            Are you sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <button id="button-delete" type="button" class="btn actionBtn btn-danger"
                                    data-dismiss="modal">
                                <span id="footer_action_button">Bạn thực sự muốn xóa ảnh này ?</span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    @endsection

</div>
<!-- /#wrapper -->

@push('scripts')
<script>
    $(document).ready(function () {
        $("a#del_img").on('click', function () {
            $('.modal-title').text('Delete');
            $('.deleteContent').show();
            var id = $(this).data('info');
            console.log(id);


            $('#button-delete').attr('onclick', "document.getElementById('product-" + id + "').submit()");
            $('#myModal').modal('show');
        });
    })
</script>
@endpush

