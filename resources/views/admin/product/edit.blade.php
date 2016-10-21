@extends('admin.layouts.app')
@section('htmlheader_title','Admin Profile')

@section('contentheader_title','Product')
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

@section('main-content')

    <section class="content paddingleft_right15">
        <div class="row">
            @if(session('thongbao'))
                <div style="padding-top: 10px" class="alert alert-success">
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
        <!-- /.col-lg-12 -->
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white" id="livicon-47"
                                               style="width: 16px; height: 16px;">
                            <svg height="16" version="1.1" width="16" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 style="overflow: hidden; position: relative;" id="canvas-for-livicon-47">
                                <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                    2.1.2
                                </desc>
                                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                <path fill="#ffffff" stroke="none"
                                      d="M21.291,21.271C20.116,20.788,19.645,19.452,19.645,19.452S19.116,19.756,19.116,18.908C19.116,18.058,19.645,19.452,20.176,16.179000000000002C20.176,16.179000000000002,21.644,15.753000000000002,21.351999999999997,12.238000000000003H20.997999999999998C20.997999999999998,12.238000000000003,21.880999999999997,8.479000000000003,20.997999999999998,7.206000000000003C20.115999999999996,5.933000000000003,19.763999999999996,5.085000000000003,17.820999999999998,4.477000000000003C15.879999999999997,3.8700000000000028,16.587999999999997,3.991000000000003,15.174999999999997,4.053000000000003C13.762999999999998,4.1140000000000025,12.585999999999997,4.902000000000003,12.585999999999997,5.325000000000003C12.585999999999997,5.325000000000003,11.703999999999997,5.386000000000003,11.351999999999997,5.750000000000003C10.998999999999997,6.1140000000000025,10.410999999999996,7.810000000000002,10.410999999999996,8.235000000000003S10.805999999999996,11.509000000000004,11.099999999999996,12.116000000000003L10.648999999999996,12.237000000000004C10.354999999999995,15.752000000000004,11.824999999999996,16.178000000000004,11.824999999999996,16.178000000000004C12.353999999999996,19.450000000000003,12.883999999999995,18.057000000000006,12.883999999999995,18.907000000000004C12.883999999999995,19.755000000000003,12.353999999999996,19.451000000000004,12.353999999999996,19.451000000000004S11.883999999999995,20.787000000000003,10.707999999999995,21.270000000000003C9.530999999999995,21.755000000000003,3.002999999999995,24.361000000000004,2.471999999999994,24.906000000000002C1.942,25.455,2.002,28,2.002,28H29.997999999999998C29.997999999999998,28,30.058999999999997,25.455,29.526999999999997,24.906C28.996,24.361,22.468,21.756,21.291,21.271Z"
                                      stroke-width="0" transform="matrix(0.5,0,0,0.5,0,0)"
                                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                            </svg>
                        </i>
                        Products Edit
                    </h4>
                </div>
                <br>
                <div class="panel-body">
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

                    <strong> Image details: </strong><br/><br/>
                    @foreach($img_detail as $item)

                        <form style="margin-bottom: 0" id="product-{{ $item->product_photo_id }}" method="post"
                              action="/admin/product/{{ $item->product_photo_id }}/edit">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="form-group col-lg-2" id="hinh-{{$item->product_photo_id}}">
                                <img class="img-responsive" src="/images/{{$item->thumbnail_photo_link}}">
                                <a id="del_img" class="btn btn-danger btn-circle icon_del"
                                   data-info="{{ $item->product_photo_id}}">
                                    <i class="fa fa-times"></i></a>
                                <input type="file" name="image" method="post" id="edit_img">
                                <button style="margin-top: 10px" class="btn btn-primary " type="submit">Sửa ảnh</button>
                            </div>
                        </form>

                        <form style="display: none" method="post"
                              action="/admin/product/{{$item->product_photo_id}}/delimg"
                              id="del-product-{{$item->product_photo_id}}">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                        </form>

                        {{--<button> Edit Image</button>--}}
                    @endforeach
                </div>
            </div>

            <!-- /.col-lg-12 -->

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
    </section>


@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $("a#del_img").on('click', function () {
            $('.modal-title').text('Delete');
            $('.deleteContent').show();
            var id = $(this).data('info');
            console.log(id);


            $('#button-delete').attr('onclick', "document.getElementById('del-product-" + id + "').submit()");
            $('#myModal').modal('show');
        });
    })

    $(document).ready(function () {
        $("edit_img").on('click', "document.getElementById('edit-product-" + id + "').submit()");
    })


</script>
@endpush

