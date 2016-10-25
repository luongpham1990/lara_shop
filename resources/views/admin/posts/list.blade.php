@extends('admin.layouts.app')

@section('htmlheader_title','Add Posts')

@section('contentheader_title','Add post')
@section('contentheader_description','Add one post')

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
                    <table id="all-posts" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($data as$item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ url('/admin/posts/'.$item->id.'/edit') }}">{{ $item->title }}</a></td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->category()->first()->name }}</td>
                                <td><img class="img-responsive" width="70" src="{{ $item->banner }}"/> </td>
a
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i> Xóa</button></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>    <!-- row-->
    </section>
@endsection

@push('scripts')
<script src="{{ asset('/plugins/datatables/jquery.datatables.min.js') }}"></script>
{{--<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>--}}
<script>
    $(document).ready(function () {
        $('#all-posts').DataTable();
    });
</script>
@endpush