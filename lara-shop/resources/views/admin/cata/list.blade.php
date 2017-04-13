@extends('admin.layouts.app')
@section('htmlheader_title','List Categories')

@section('contentheader_title','List Category')
@section('contentheader_description','Danh sách Category')
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

<!-- Navigation -->

@section('main-content')
    <!-- Page Content -->

    <section class="content paddingleft_right15">
        <div class="row">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif

            @if(count($errors)>0)

                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"
                       title="close">×</a>
                    @foreach($errors->all() as $error)

                        <p><strong>{{ $error }}!</strong></p>
                    @endforeach
                </div>

            @endif

            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white" id="livicon-47"
                                               style="width: 16px; height: 16px;">
                        </i>
                        List Category
                    </h4>
                </div>
                <br>
                <div class="panel-body">
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Edit</th>
                            <th style="ext-align: center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cata as $ct)
                            <tr class="odd gradeX" align="center">
                                <td>{{$ct->catalog_id  }}</td>
                                <td>{{$ct->catalog_name}}</td>

                                <td><a href="{{url('/admin/cata/'.$ct->catalog_id).'/edit/'}}"
                                       class="edit-modal btn btn-primary">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a></td>

                                <td>
                                    <button class="delete-modal btn btn-danger" onclick=""
                                            data-info="{{ $ct->catalog_id }}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                                <form id="abc-{{ $ct->catalog_id }}" method="post"
                                      action="/admin/cata/{{ $ct->catalog_id }}/delete/">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

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
                                <span id="footer_action_button">Bạn thực sự muốn xóa</span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /#page-wrapper -->
@endsection
@push('scripts')
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

</script>

@endpush
