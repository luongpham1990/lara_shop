@extends('shop.layouts.admin-app')
@section('title')
@endsection
<body>

<div id="wrapper">

    <!-- Navigation -->

@section('content')



    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <form action="/admin/product/add" method="POST" enctype="multipart/form-data">

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
                                       placeholder="Please Enter Productname"/>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" id="price" placeholder="Please Enter Price"/>
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="description" id="description" rows="10"
                                          name="txtContent"></textarea>
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


                            <button type="submit" class="btn btn-default">Add Product</button>
                            <button type="reset" class="btn btn-default">Reset</button>


                        </div>
                        <strong style="font-size: 20px">Featured image: </strong><br/><br/>
                        <div class="form-group">
                            @for($i=1; $i<=3; $i++)
                                <label>Featured image {{$i}}</label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input name="image[]" type="file">
                                    <div class="fileupload-preview">
                                        <img src="" alt="" id="blah" class="img-responsive">
                                    </div>
                                </div>
                                <br/>
                            @endfor

                        </div>
                    </div>
                </form>

                @endsection

            </div>
            <!-- /#wrapper -->
        </div>
</div>
</div>
</body>

</html>