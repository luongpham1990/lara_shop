@extends('admin.layouts.app')

@section('htmlheader_title','List Categories')

@section('contentheader_title','list Category')
@section('contentheader_description','Danh sách category')

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Category</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Button</th>
                        </tr>


                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ url('/admin/categories/'.$item->id.'/edit') }}"> {{ $item->name }}</a> </td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <button onclick="showModalDelete({{$item->id }})" class="btn btn-flat btn-danger"><i
                                                class="fa fa-trash"></i> Delete
                                    </button>

                                    <form id="delete-{{ $item->id }}" action="{{ url('/admin/categories/'.$item->id) }}"
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
                    <button type="button" id="delete-button" class="btn btn-delete"><i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('scripts')
<script type="text/javascript">

    function showModalDelete(id) {

        $('#delete-button').attr('onclick', "$('#delete-" + id + "').submit()");
        $('#delete-modal').modal('show');

    }

</script>
@endpush