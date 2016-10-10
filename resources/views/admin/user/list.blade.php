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
        <!-- Navigation -->


        @section('content')
            <!-- Page Content -->

                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
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
                            <div class="col-lg-12">
                                <h1 class="page-header">User
                                    <small>List</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead  style="background: none">
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->email}}</td>
                                    <td> @if ($item->confirmed == 1)
                                            {{ 'active' }}
                                        @else
                                            {{ "No Active" }}

                                        @endif </td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="center"><a href="{{url('/admin/user/'.$item->id).'/edit/'}}"><button class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Edit</button></a> </td>
                                    <td class="center"><button class="delete-modal btn btn-danger btn-flat" onclick="" data-info="{{ $item->id }}">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>
                                    </td>
                                    <form id="user-{{ $item->id }}" method="post"
                                          action="/admin/user/{{ $item->id }}/delete/">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

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
                                        Are you Sure you want to delete <span class="dname"></span> ? <span
                                                class="hidden did"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="button-delete" type="button" class="btn actionBtn btn-danger"
                                                data-dismiss="modal">
                                            <span id="footer_action_button" class='glyphicon'>Bạn có thực sự muốn xóa</span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                                            <span class='glyphicon glyphicon-remove'></span> Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /#page-wrapper -->

            @endsection

            @push('script')
            <script>
                $(document).ready(function () {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                $(document).on('click', '.delete-modal', function () {
                    $('.modal-title').text('Delete');
                    $('.deleteContent').show();
                    var id = $(this).data('info');
                    console.log(id);

                    $('#button-delete').attr('onclick', "document.getElementById('abc-" + id + "').submit()");
                    $('#myModal').modal('show');
                });

                function fillmodalData(details) {
                    $('#fid').val(details[0]);
                    $('#title').val(details[1]);
                    $('#image').val(details[2]);
                    $('#author').val(details[3]);
                    $('#content').val(details[4]);
                    $('#category_id').val(details[5]);
                }

                $(document).on('click', '.delete-modal', function () {
                    $('.modal-title').text('Delete');
                    $('.deleteContent').show();
                    var id = $(this).data('info');
                    console.log(id);

                    $('#button-delete').attr('onclick', "document.getElementById('user-" + id + "').submit()");
                    $('#myModal').modal('show');
                });

            </script>

            @endpush
