@extends('admin.layouts.admin-app')
@section('title')
@endsection

@section('content')
    <style type="text/css">.thumb-image{float:left;width:170px;position:relative;padding:10px;}</style>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <form action="/admin/product/add" method="POST" enctype="multipart/form-data" runat="server">

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
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" id="name"
                                   placeholder="Please Enter Productname" value="{{old('name')}}"/>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" name="price" id="price" value="{{old("price")}}" placeholder="Please Enter Price"/>
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" value="{{old("description")}}"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Product Catalog</label>
                            <select id="catalog" class="form-control input-lg" name="catalog" >
                                @foreach($cata as $ct)
                                    <option value="{{$ct->catalog_id}}">{{$ct->catalog_name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Product Brand</label>
                            <input id="brand" class="form-control input-lg" name="brand" value="{{old("brand")}}" placeholder="Please Enter Product Brand">
                        </div>

                        <div class="form-group">
                            <label>Product Status</label>
                            <label class="radio-inline" id="productstatus">
                                <input name="rdoStatus" value="1" checked="" type="radio">Visible
                            </label>                            <label class="radio-inline">
                                <input name="rdoStatus" value="0" type="radio">Invisible
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                    <strong style="font-size: 20px">Featured image: </strong><br/><br/>
                    <div class="form-group">
                        <label>Featured image</label>
                        <div id="wrapper" style="margin-top: 10px;"><input id="fileUpload" multiple="multiple" type="file" name="image[]"/>
                            <div id="image-holder"></div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $("#fileUpload").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++)
                {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
        }
    });
});

</script>
<script>

</script>

@endpush



