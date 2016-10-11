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
</style>
@endpush
<body>

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
                        <form method="POST" action="/admin/product/{{$pro->id}}/edit" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Please Enter Productname" value="{{$pro->product_name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" id="price" placeholder="Please Enter Price" value="{{$pro->price}}"/>
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" name="txtContent">{{$pro->description}}</textarea>
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
                                <input id="brand" class="form-control input-lg" name="brand" value="{{$pro->brand}}" placeholder="Please Enter Brand">
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

                            <button type="submit" class="btn btn-primary">Edit Product</button>
                            <button type="reset" class="btn btn-danger">Reset</button>

                            <div class="fileupload-preview img-responsive" id="image-holder"></div>

                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    @endsection

</div>
<!-- /#wrapper -->


</body>

</html>
