@extends('admin.layouts.app')
@section('htmlheader_title','Admin Profile')

@section('contentheader_title','Product')
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
    {{--<div id="page-wrapper">--}}


        {{--<div class="container-fluid">--}}
    <section class="content paddingleft_right15">
        <div class="row">
            @if(session('thongbao'))
                <div style="padding-top: 10px" class="alert alert-success">
                    {{session('thongbao')}}
                </div>
        @endif
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white" id="livicon-47"
                                               style="width: 16px; height: 16px;">
                        </i>
                        Products List
                    </h4>
                </div>
                <br>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center" style="text-align: center">
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Price</th>
                            <th style="text-align: center">View</th>
                            <th style="text-align: center">Catalog</th>
                            <th style="width: 170px;">Featured image</th>
                            <th style="text-align: center">Description</th>
                            <th style="text-align: center">Edit</th>
                            <th style="text-align: center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($product_img as pro_img)--}}
                        @foreach($product as $pro)
                            <tr class="odd gradeX " align="center">
                                <td>{{$pro->id}}</td>
                                <td>{{$pro->product_name}}</td>
                                <td>{{number_format($pro->price,0,",",".")}} VNĐ</td>
                                <td>{{$pro->view}}</td>

                                <td>
                                    {{ \App\Catalog::find($pro->catalog_id)->catalog_name }}
                                </td>
                                <td>
                                    <img class="img-responsive" src="/images/{{$pro->getImageFeature()}}">
                                </td>

                                <td>{{$pro->description}}</td>

                                <td><a href="/admin/product/{{ $pro->id }}/edit/"
                                       class=" col-md-12 edit-modal btn btn-primary">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </a>
                                </td>
                                <td>
                                    <button class=" col-md-9 delete-modal btn btn-danger" onclick=""
                                            data-info="{{ $pro->id }}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>

                                <form id="product-{{ $pro->id }}" method="post"
                                      action="/admin/product/{{ $pro->id }}/delete/">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                </form>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        <!-- /.col-lg-12 -->

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
                            Are you sure you want to delete <span class="dname"></span> ? <span
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
    </section>

            <!-- /.row -->
        {{--</div>--}}



        <!-- /.container-fluid -->
    {{--</div>--}}
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

        $('#button-delete').attr('onclick', "document.getElementById('product-" + id + "').submit()");
        $('#myModal').modal('show');
    });

    $(document).ready(function () {
        $
    })
</script>

@endpush