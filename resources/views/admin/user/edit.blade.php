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
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
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
                    <form action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
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
                                    <a href="#" data-pk="1" class="editable editable-click" type="textarea"
                                       data-title="Edit Id">{{$user->id}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" id="username" class="editable editable-click" name="username" type="textarea"
                                       data-title="Edit User Name">{{$user->username}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" class="editable editable-click" name="email" type="textarea"
                                       data-title="Edit User Email">{{$user->email}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" id="address" class="editable editable-click" name="address" type="textarea"
                                       data-title="Edit User Address">{{$user->address}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" id="phone" class="editable editable-click" name="phone" type="textarea"
                                       data-title="Edit User Phone">{{$user->phone}}</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" id="status" class="editable editable-click" name="confirmed" type="textarea"
                                       data-title="Edit Status"> @if ($user->confirmed == 1)
                                            {{ 'Active' }}
                                        @else
                                            {{ "No Active" }}

                                        @endif</a>
                                </td>
                                <td>
                                    <a href="#" data-pk="1" id="admin" class="editable editable-click" name="is_admin" type="textarea"
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


                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@push('script')
<script>
    $('#username').editable({
        type: 'text',
        pk: 1,
        url: '/post',
        title: 'Enter username'
    });
    $('#address').editable({
        type: 'text',
        pk: 1,
        url: '/post',
        title: 'Enter username'
    });
    $('#phone').editable({
        type: 'text',
        pk: 1,
        url: '/post',
        title: 'Enter username'
    });
    $('#status').editable({
        type: 'select',
        title: 'Enter Status',
        url: '/post',
        placement: 'right',
        value: 2,
        source: [
            {value: 1, text: 'Active'},
            {value: 1, text: 'No Active'}
        ]
    });
    $('#admin').editable({
        type: 'select',
        title: 'Enter Admin',
        url: '/post',
        placement: 'right',
        value: 2,
        source: [
            {value: 1, text: 'Admin'},
            {value: 1, text: 'User'}
        ]
    });

</script>

@endpush

