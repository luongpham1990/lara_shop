@extends('admin.layouts.app')
@section('htmlheader_title')
    Admin Profile
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

    /*.thumb-image{*/
    /*float:left;width:170px;position:relative;padding:10px;*/
    /*}*/
</style>
@endpush
@section('contentheader_title')
    Admin Area
@endsection
@section('main-content')
    <div id="page-wrapper">
        {{--<section id="form">--}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav  nav-tabs ">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                Admin Profile</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">
                                Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade active in">
                            <form method="post"
                                  action="{{url('/admin/'.$user->id.'/edit')}}"
                                  enctype="multipart/form-data"
                                  runat="server">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h2>
                                                    Thông tin Admin
                                                </h2>
                                            </div>
                                            <div class="panel-body">

                                                @if(session('oldsida'))
                                                    <div class="alert alert-danger alert-dismissible fade in"
                                                         role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong> {{ session('oldsida') }}  </strong>
                                                    </div>
                                                @endif
                                                @if(session('alert'))
                                                    <div class="alert alert-info alert-dismissible fade in"
                                                         role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong> {{ session('alert') }}  </strong>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="signup-form"><!--sign up form-->
                                                            <form method="post"
                                                                  action="{{url('/admin/'.$user->id.'/edit')}}"
                                                                  enctype="multipart/form-data" runat="server">
                                                                {{ csrf_field() }}
                                                                {{method_field('PUT')}}
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label><strong style="font-size: 20px">Profile
                                                                                Image </strong></label><br/><br/>
                                                                        <img src="{{$user->avatar}}"
                                                                             class="img-responsive" alt="avatars"
                                                                             style="border-radius: 50%; margin-bottom: 20px ">
                                                                        <input type="file" name="avatars">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{csrf_field()}}
                                                                        <label><strong style="font-size: 20px">Profile
                                                                                Information </strong></label><br/><br/>
                                                                        <div class="form-group">
                                                                            <label for="username"> Tên tài khoản</label>
                                                                            <input class='form-control ' id="username"
                                                                                   name="username"
                                                                                   value="{{$user->username}}"
                                                                                   type="text"/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email </label>
                                                                            <input class='form-control' id="email"
                                                                                   name="email"
                                                                                   value="{{$user->email}}"
                                                                                   type="email" disabled/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Mật khẩu</label>
                                                                            <input class='form-control' id="password"
                                                                                   name="password"
                                                                                   value="123456789" type="password"
                                                                                   disabled/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="userphone"> Số điện
                                                                                thoại</label>
                                                                            <input class='form-control' id="userphone"
                                                                                   name="phone"
                                                                                   value="{{$user->phone}}"
                                                                                   type="number"
                                                                            />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="address"> Địa chỉ</label>
                                                                            <input class='form-control' id="address"
                                                                                   name="address"
                                                                                   value="{{$user->address}}"
                                                                                   type="text"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary " type="submit">
                                                                        Submit
                                                                    </button>
                                                                    <button type="reset" class="btn btn-primary reset_btn
                                                           " value="Reset">
                                                                        Reset
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div><!--/sign up form-->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12 pd-top">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                Chaneg Password
                                            </h3>
                                        </div>
                                        <div class="panel-body">


                                            <div class="form-group">
                                                <form action="{{url('/admin/'.$user->id.'/changepass')}}"
                                                      class="form-horizontal"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('PUT')}}
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="inputoldpassword"
                                                                   class="col-md-3 control-label">
                                                                Old Password
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="password" id="oldpassword"
                                                                           placeholder="Old Password"
                                                                           class="form-control" name="oldpassword">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="newpassword"
                                                                   class="col-md-3 control-label">
                                                                Password
                                                                {{--<span class='require'>*</span>--}}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="password" id="newpassword"
                                                                           placeholder="New Password"
                                                                           class="form-control" name="newpassword"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputrepassword" class="col-md-3 control-label">
                                                                Confirm Password
                                                                {{--<span class='require'>*</span>--}}
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="password" id="inputrepassword"
                                                                           placeholder="Confirm Password"
                                                                           class="form-control"
                                                                           name="newpassword_confirmation"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" class="btn btn-primary">Submit
                                                            </button>
                                                            &nbsp;
                                                            {{--<button type="button" class="btn btn-danger">Cancel--}}
                                                            {{--</button>--}}
                                                            &nbsp;
                                                            <button type="reset" class="btn btn-primary reset_btn
                                                           " value="Reset">
                                                                Reset
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--</section>--}}
    </div>


@endsection
@push('scripts')
<script>
    var a = {};

    $('#status').editable({
        ajaxOptions: {
            type: 'put',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        url: '/admin/user/edituser/',
        success: function (response, newValue) {
            console.log(response);
            if (response.status == 'error') return response.msg; //msg will be shown in editable form
            a = response;
        }, source: [
            {value: 1, text: 'Active'},
            {value: 0, text: 'No Active'}
        ]
    });
    $('#admin').editable({
        ajaxOptions: {
            type: 'put',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        url: '/admin/user/edituser/',
        success: function (response, newValue) {
            console.log(response);

            if (response.status == 'error') return response.msg; //msg will be shown in editable form

            a = response;
        }, source: [
            {value: 1, text: 'Admin'},
            {value: 0, text: 'Dan thuong'}
        ]
    });
    $('.editable').editable({
        ajaxOptions: {
            type: 'put',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        url: '/admin/user/edituser/',
        success: function (response, newValue) {
            console.log(response);

            if (response.status == 'error') return response.msg; //msg will be shown in editable form

            a = response;
        }
    });
    //    $('#address').editable({
    //        type: 'text',
    //        pk: 1,
    //        url: '/post',
    //        title: 'Enter username'
    //    });
    //    $('#phone').editable({
    //        type: 'text',
    //        pk: 1,
    //        url: '/post',
    //        title: 'Enter username'
    //    });

    //    $('#admin').editable({
    //        type: 'select',
    //        title: 'Enter Admin',
    //        url: '/post',
    //        placement: 'right',
    //        value: 2,
    //        source: [
    //            {value: 1, text: 'Admin'},
    //            {value: 1, text: 'User'}
    //        ]
    //    });

</script>
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
                            "class": "img-responsive"
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