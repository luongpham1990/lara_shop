@extends('admin.layouts.app')

@section('htmlheader_title','List Cateblog')

@section('contentheader_title','Cateblog')
@section('contentheader_description','Danh sách Cateblog')
@push('links')
{{--<link href="{{ asset('/plugins/datatables/jquery.datatables.css') }}" rel="stylesheet" type="text/css">--}}
{{--<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">--}}
@endpush
@section('main-content')
    <section class="content paddingleft_right15">
        <div class="row">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong> {{ session('error') }}  </strong>
                </div>
            @endif
            @if(session('alert'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong> {{ session('alert') }}  </strong>
                </div>
            @endif
            <div class="col-xs-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white" id="livicon-47"
                                                   style="width: 16px; height: 16px;">
                            </i>
                            List Cateblog
                        </h4>
                    </div>
                    <br>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($blog as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('/admin/catablog/'.$item->id.'/edit') }}"> {{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><a href="/admin/cateblog/{{ $item->id }}/edit/"
                                           class=" col-md-12 edit-modal btn btn-primary">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                    </td>
                                    <td class="center">
                                        <button class="delete-modal btn btn-danger btn-flat" onclick=""
                                                data-info="{{ $item->id }}">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>
                                    </td>
                                    <form id="cateblog-{{ $item->id }}" method="post"
                                          action="/admin/cateblog/{{ $item->id }}/delete/">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

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
                            Bạn thực sự muốn xóa bản ghi này <span class="dname"></span> ? <span
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
    </section>
@endsection

@push('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });

    //    function fillmodalData(details) {
    //        $('#fid').val(details[0]);
    //        $('#title').val(details[1]);
    //        $('#image').val(details[2]);
    //        $('#author').val(details[3]);
    //        $('#content').val(details[4]);
    //        $('#category_id').val(details[5]);
    //    }

    $(document).on('click', '.delete-modal', function () {
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        var id = $(this).data('info');
        console.log(id);

        $('#button-delete').attr('onclick', "document.getElementById('cateblog-" + id + "').submit()");
        $('#myModal').modal('show');
    });

</script>
<script>
    $(document).ready(function () {
        $('#all-posts').DataTable();
    });
</script>
@endpush