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
</style>
@endpush

@section('main-content')
    <!-- Page Content -->
    <section class="content paddingleft_right15">
        <div class="row">

            <!-- /.col-lg-12 -->

            <form action="" method="POST">
                {{csrf_field()}}
                {{method_field('PUT')}}
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
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Admin</th>
                                {{--<th>Time</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    <a href="#" data-pk="{{$user->id}}" id="username" class="editable editable-click"
                                       name="username" type="textarea"
                                       data-title="Edit User Name">{{$user->username}}</a>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <a href="#" data-pk="{{$user->id}}" id="address" class="editable editable-click"
                                       name="address" type="textarea"
                                       data-title="Edit User Address">{{$user->address}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="{{$user->id}}" id="phone" class="editable editable-click"
                                       name="phone" type="textarea"
                                       data-title="Edit User Phone">{{$user->phone}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="{{ $user->id }}" id="status" data-name="confirmed"
                                       class="editable editable-click" name="confirmed" data-type="select"
                                       data-title="Edit Status"> @if ($user->confirmed == 1)
                                            {{ 'Active' }}
                                        @else
                                            {{ "No Active" }}

                                        @endif</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="{{ $user->id }}" id="admin" class="editable editable-click"
                                       data-name="is_admin" name="is_admin" data-type="select"
                                       data-title="Edit Admin"> @if ($user->is_admin == 1)
                                            {{ 'Admin' }}
                                        @else
                                            {{ "User" }}

                                        @endif</a>
                                </td>
                                {{--<td>--}}
                                {{--<a href="#" data-pk="1" class="editable editable-click" type="textarea"--}}
                                {{--data-title="Edit User Name">{{$user->created_at}}</a>--}}
                                {{--</td>--}}
                                {{--<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>--}}
                                {{--<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <!-- /.row -->
    </section>
    <!-- /.container-fluid -->

    <!-- /#page-wrapper -->
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

@endpush

