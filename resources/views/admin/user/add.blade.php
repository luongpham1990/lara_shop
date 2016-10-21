@extends('admin.layouts.app')
@section('htmlheader_title')
    Admin Profile
@endsection
@section('contentheader_title')
    User Area
@endsection

@section('main-content')
    <!-- Page Content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <form action="{{url('/admin/user/add')}}" method="POST" enctype="multipart/form-data" runat="server">

                @if(session('alert'))
                    <div class="alert alert-success">
                        {{session('alert')}}
                    </div>
                @endif
                @if(count($errors))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach( $errors->all() as $item)
                                <li> {{ $item }}  </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{--<div class="row">--}}
                    <div class="panel panel-primary ">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                                       data-c="#fff" data-hc="white" id="livicon-47"
                                                       style="width: 16px; height: 16px;">
                                    <svg height="16" version="1.1" width="16" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         style="overflow: hidden; position: relative;" id="canvas-for-livicon-47">
                                        <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                            Raphaël
                                            2.1.2
                                        </desc>
                                        <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                        <path fill="#ffffff" stroke="none"
                                              d="M21.291,21.271C20.116,20.788,19.645,19.452,19.645,19.452S19.116,19.756,19.116,18.908C19.116,18.058,19.645,19.452,20.176,16.179000000000002C20.176,16.179000000000002,21.644,15.753000000000002,21.351999999999997,12.238000000000003H20.997999999999998C20.997999999999998,12.238000000000003,21.880999999999997,8.479000000000003,20.997999999999998,7.206000000000003C20.115999999999996,5.933000000000003,19.763999999999996,5.085000000000003,17.820999999999998,4.477000000000003C15.879999999999997,3.8700000000000028,16.587999999999997,3.991000000000003,15.174999999999997,4.053000000000003C13.762999999999998,4.1140000000000025,12.585999999999997,4.902000000000003,12.585999999999997,5.325000000000003C12.585999999999997,5.325000000000003,11.703999999999997,5.386000000000003,11.351999999999997,5.750000000000003C10.998999999999997,6.1140000000000025,10.410999999999996,7.810000000000002,10.410999999999996,8.235000000000003S10.805999999999996,11.509000000000004,11.099999999999996,12.116000000000003L10.648999999999996,12.237000000000004C10.354999999999995,15.752000000000004,11.824999999999996,16.178000000000004,11.824999999999996,16.178000000000004C12.353999999999996,19.450000000000003,12.883999999999995,18.057000000000006,12.883999999999995,18.907000000000004C12.883999999999995,19.755000000000003,12.353999999999996,19.451000000000004,12.353999999999996,19.451000000000004S11.883999999999995,20.787000000000003,10.707999999999995,21.270000000000003C9.530999999999995,21.755000000000003,3.002999999999995,24.361000000000004,2.471999999999994,24.906000000000002C1.942,25.455,2.002,28,2.002,28H29.997999999999998C29.997999999999998,28,30.058999999999997,25.455,29.526999999999997,24.906C28.996,24.361,22.468,21.756,21.291,21.271Z"
                                              stroke-width="0" transform="matrix(0.5,0,0,0.5,0,0)"
                                              style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    </svg>
                                </i>
                                Products List
                            </h4>
                        </div>
                        <br>
                        <!-- /.col-lg-12 -->
                        <div class="panel-body">
                            <div class="col-lg-4">
                                {{csrf_field()}}
                                <strong style="font-size: 20px">Featured image: </strong><br/><br/>
                                <div class="form-group">
                                    <label>Featured image</label>
                                    <div id="wrapper" style="margin-top: 10px;"><input id="fileUpload"
                                                                                       multiple="multiple"
                                                                                       type="file" name="image[]"/>
                                        <div id="image-holder"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8" style="padding-bottom:120px">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" placeholder="Please Enter Username"
                                           value="{{old('username')}}"/>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Please Enter Password"/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>RePassword</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="Please Enter RePassword"/>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="Please Enter Email" value="{{old('email')}}"/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                           placeholder="Please Enter Address" value="{{old('address')}}"/>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>User Level</label>
                                    <label class="radio-inline">
                                        <input name="Level" value="1" checked="" type="radio">Admin
                                    </label>
                                    <label class="radio-inline">
                                        <input name="Level" value="2" type="radio">
                                        Member
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary">User Add</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                {{--</div>--}}
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection



@push('script')
<script>
    $(document).ready(function () {
        $("#fileUpload").on('change', function () {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-holder");
            image_holder.empty();
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
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

@endpush
