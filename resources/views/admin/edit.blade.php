@extends('admin.layouts.admin-app')
@section('title')
@endsection
@push('link')
<style>
   .center a{
      color: #FFFFFF;
   }
   table.dataTable thead .sorting {
      background: none;
   }
   table.dataTable thead .sorting_asc{
      background: none;
   }
</style>
@endpush
@section('content')
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
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       <strong> {{ session('oldsida') }}  </strong>
                                    </div>
                                 @endif
                                 @if(session('alert'))
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       <strong> {{ session('alert') }}  </strong>
                                    </div>
                                 @endif
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <div class="fileupload-preview thumbnail img-file">
                                             <img class="img-responsive" src="{{ url('/images/shop/noimagefound.jpg') }}"
                                                  data-src=""
                                                  alt="dm huy HUng nhe" >
                                          </div>

                                          <div class="fileupload fileupload-new"
                                               data-provides="fileupload">
                                                                    <span class="btn btn-primary btn-file">
                                                                <span class="fileupload-new">Select file</span>
                                                                <span class="fileupload-exists">Change</span>
                                                                 <input name="image" type="file">
                                                            </span>
                                             <a href="#" class="close fileupload-exists"
                                                data-dismiss="fileupload"
                                                style="float: none">×</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-8">

                                       <div class="signup-form"><!--sign up form-->
                                          <form method="post" action="{{url('/edit/'.$user->id)}}">
                                             {{ csrf_field() }}
                                             {{method_field('put')}}
                                             {{--@if(count($errors))--}}
                                             {{--@foreach ($errors->all() as $error)--}}
                                             {{--<div>{{ $error }}</div>--}}
                                             {{--@endforeach--}}
                                             {{--@endif--}}
                                             <div class="form-group">
                                                <label for="username"> Tên tài khoản</label>
                                                <input class='form-control ' id="username" name="username" value="{{$user->username}}"
                                                       type="text" />
                                             </div>
                                             <div class="form-group">
                                                <label for="email">Email </label>
                                                <input class='form-control'  id="email" name="email" value="{{$user->email}}"
                                                       type="email" disabled/>
                                             </div>
                                             <div class="form-group">
                                                <label for="password">Mật khẩu</label>
                                                <input class='form-control' id="password" name="password"
                                                       value="123456789" type="password"
                                                       disabled/>
                                             </div>
                                             <div class="form-group">
                                                <label for="userphone"> Số điện thoại</label>
                                                <input class='form-control' id="userphone" name="phone"
                                                       value="{{$user->phone}}" type="number"
                                                />
                                             </div>
                                             <div class="form-group">
                                                <label for="address"> Địa chỉ</label>
                                                <input class='form-control' id="address"
                                                       name="address"
                                                       value="{{$user->address}}" type="text"
                                                />
                                             </div>
                                          </form>
                                       </div><!--/sign up form-->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
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
                                    <form action="{{url('/edit/'.$user->id)}}" class="form-horizontal" method="post">
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
                                             <label for="inputnewpassword"
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
                                                          class="form-control" name="renewpassword"/>
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
@push('script')
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
      success: function(response, newValue) {
         console.log(response);
         if(response.status == 'error') return response.msg; //msg will be shown in editable form
         a =response;
      },source: [
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
      success: function(response, newValue) {
         console.log(response);

         if(response.status == 'error') return response.msg; //msg will be shown in editable form

         a =response;
      },source: [
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
      success: function(response, newValue) {
         console.log(response);

         if(response.status == 'error') return response.msg; //msg will be shown in editable form

         a =response;
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

@endpush