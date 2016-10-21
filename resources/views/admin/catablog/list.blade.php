@extends('admin.layouts.app')

@section('htmlheader_title','List Categories')

@section('contentheader_title','list Category')
@section('contentheader_description','Danh sách category')
@push('links')
<link href="{{ asset('/plugins/datatables/jquery.datatables.css') }}" rel="stylesheet" type="text/css">
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
                            Tickets List
                        </h4>
                    </div>
                    <br>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>


                            @foreach($blog as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('/admin/catablog/'.$item->id.'/edit') }}"> {{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><a href="/admin/product/{{ $item->id }}/edit/"
                                           class=" col-md-12 edit-modal btn btn-primary">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <button onclick="showModalDelete({{$item->id }})"
                                                class="btn btn-flat btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>

                                        <form id="delete-{{ $item->id }}"
                                              action="{{ url('/admin/categories/'.$item->id) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>

                                    </td>
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

        <div class="modal fade modal-danger" id="delete-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Xóa</h4>
                    </div>
                    <div class="modal-body">
                        <p>Xác nhận xóa category&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="delete-button" class="btn btn-delete"><i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>
@endsection

@push('scripts')
<script type="text/javascript">

    function showModalDelete(id) {

        $('#delete-button').attr('onclick', "$('#delete-" + id + "').submit()");
        $('#delete-modal').modal('show');

    }

</script>
@endpush