<!DOCTYPE html>
<html>
<head>
    <title> Catalogs </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
            src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script
            src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<style>
</style>
<body>
<div class="container ">

    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
    @endif

    {{ csrf_field() }}
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Catalogs
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr text-align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <div class="pull-right">
                        <a href="/admin/cata/add" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add new</a>
                    </div>
                    <tbody>

                    @foreach($cata as $ct)
                        <tr class="odd gradeX" align="center">
                            <td>{{$ct->id  }}</td>
                            <td>{{$ct->name}}</td>

                            <td><a href="/admin/cata/edit/{{ $ct->id }}" class="edit-modal btn btn-info">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>

                                <button class="delete-modal btn btn-danger" onclick="" data-info="{{ $ct->id }}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>


                            <form id="abc-{{ $ct->id }}" method="post" action="/admin/cata/delete/{{ $ct->id }}">
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
    </div>
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
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button id="button-delete" type="button" class="btn actionBtn btn-danger" data-dismiss="modal">
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

<script>


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


</script>

</body>
</html>
