@extends('admin.layouts.app')
@section('htmlheader_title','Create User')

@section('contentheader_title','User')
@section('contentheader_description','Thêm mới User')

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
                                </i>
                                Create User
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


{{--@include('sweet::alert')--}}
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
<script>

</script>

@endpush
