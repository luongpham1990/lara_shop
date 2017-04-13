@extends('admin.layouts.app')
@section('htmlheader_title','List Post')

@section('contentheader_title','Post')
@section('contentheader_description','Danh sách Post')
@push('link')
{{--<link href="{{ asset('/plugins/datatables/jquery.datatables.css') }}" rel="stylesheet" type="text/css">--}}
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
@section('main-content')
    <!-- Page Content -->

    <section class="content paddingleft_right15">
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
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white" id="livicon-47"
                                               style="width: 16px; height: 16px;">
                        </i>
                        List Post
                    </h4>
                </div>
                <br>
                <div class="panel-body">
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead  style="background: none">
                        <tr align="center">
                            <th>id</th>
                            <th>Name</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Action</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->body}}</td>
                                <td>  {{ \App\Cateblog::find($item->category_id)->name }} </td>
                                <td><img src="{{$item->banner}}" alt="" class="img-responsive img-thumbnail" style="max-width: 100px;"></td>
                                <td>{{$item->active}}</td>
                                <td class="center"><a href="{{url('/admin/post/'.$item->id).'/edit/'}}"><button class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Edit</button></a> </td>
                                <td class="center"><button class="delete-modal btn btn-danger btn-flat" onclick="" data-info="{{ $item->id }}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                                <form id="post-{{ $item->id }}" method="post"
                                      action="/admin/post/{{ $item->id }}/delete/">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

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
    <!-- /#page-wrapper -->

@endsection

@push('scripts')
<script>
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

        $('#button-delete').attr('onclick', "document.getElementById('post-" + id + "').submit()");
        $('#myModal').modal('show');
    });

</script>

@endpush
