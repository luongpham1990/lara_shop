@extends('admin.layouts.app')

@section('htmlheader_title','Add Categories')

@section('contentheader_title','Add Category')
@section('contentheader_description','Add one category')

@push('links')

<style>
    .the-box {
        padding: 15px;
        margin-bottom: 30px;
        border: 1px solid #D5DAE0;
        position: relative;
        background: white;
    }

    /*Blog  custom code*/

    .featured-post-wide {
        position: relative;
        margin: 0 0 30px;
        overflow: hidden;
    }

    .the-box {
        padding: 15px;
        margin-bottom: 30px;
        border: 1px solid #D5DAE0;
        position: relative;
        background: white;
    }

    .featured-post-wide .featured-text {
        position: relative;
        background: #fff;
        padding: 15px 15px 15px 40px;
        z-index: 3;
    }

    .additional-post {
        padding: 10px 15px 10px 0;
    }

    .box {
        width: 270px;
    }

    .article {
        padding: 8px;
        line-height: 1;
        border: 1px solid #ddd;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
        margin-bottom: 10px;
        position: relative;
    }

    .article h4 {
        margin: 14px 0 4px 0;
    }

    h4 {
        font-size: 16px;
    }

    h3 {
        font-size: 17px;
    }

    .hide-text {
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .input-block-level {
        display: block;
        width: 100%;
        min-height: 30px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .btn-file {
        overflow: hidden;
        position: relative;
        vertical-align: middle;
    }

    .btn-file > input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        filter: alpha(opacity=0);
        transform: translate(-300px, 0) scale(4);
        font-size: 23px;
        direction: ltr;
        cursor: pointer;
    }

    .fileupload {
        margin-bottom: 9px;
    }

    .fileupload .uneditable-input {
        display: inline-block;
        margin-bottom: 0px;
        vertical-align: middle;
        cursor: text;
    }

    .fileupload .thumbnail {
        overflow: hidden;
        display: inline-block;
        margin-bottom: 5px;
        vertical-align: middle;
        text-align: center;
    }

    .fileupload .thumbnail > img {
        display: inline-block;
        vertical-align: middle;
        max-height: 100%;
    }

    .fileupload .btn {
        vertical-align: middle;
    }

    .fileupload-exists .fileupload-new, .fileupload-new .fileupload-exists {
        display: none;
    }

    .fileupload-inline .fileupload-controls {
        display: inline;
    }

    .fileupload-new .input-append .btn-file {
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
    }

    .thumbnail-borderless .thumbnail {
        border: none;
        padding: 0;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }

    .fileupload-new.thumbnail-borderless .thumbnail {
        border: 1px solid #ddd;
    }

    .padding_20px {
        padding: 20px;
    }

    .padding_20px .hr {
        border-top: 1px solid #ccc;
        clear: both;
        padding-top: 10px;
    }

    .padding_bottom_none {
        padding-bottom: 0px;
    }

    .bootstrap-select .btn {
        width: 140%;
        background: #fff;
        border: 1px solid #ccc;
    }

    .fileupload-preview {
        margin-top: 10px;
    }

    .bootstrap-select.btn-group .dropdown-menu {
        min-width: 100%;
    }

    .bootstrap-select.btn-group .btn .caret {
        position: absolute;
        right: 5px;
        top: 15px;
        color: #555;
    }

    .padding_20px .livicon {
        padding-right: 15px !important;
    }

    .padding_20px p {
        font-size: 12px;
    }

    .nopadleftright {
        padding-left: 0px;
        padding-right: 0px;
    }

    /*add new blog */
    /*summer note */
    .summernote-editable {
        height: 300px;
        width: 100%;
    }

</style>
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
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="users-add" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white" id="livicon-47"
                                               style="width: 16px; height: 16px;">
                            <svg height="16" version="1.1" width="16" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 style="overflow: hidden; position: relative;" id="canvas-for-livicon-47">
                                <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                    2.1.2
                                </desc>
                                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                <path fill="#ffffff" stroke="none"
                                      d="M25,2C22.238,2,20,4.24,20,7S22.238,12,25,12S30,9.76,30,7S27.762,2,25,2ZM28,8H26V10H24V8H22V6H24V4H26V6H28V8Z"
                                      transform="matrix(0.5,0,0,0.5,0,0)" stroke-width="0"
                                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                <path fill="#ffffff" stroke="none"
                                      d="M18.379,24.414C17.391000000000002,24.008000000000003,16.994,22.881,16.994,22.881S16.549,23.137,16.549,22.424C16.549,21.707,16.994,22.881,17.442,20.122999999999998C17.442,20.122999999999998,18.676000000000002,19.763999999999996,18.43,16.801H18.134999999999998C18.134999999999998,16.801,18.877,13.630999999999998,18.134999999999998,12.559999999999999C17.391,11.486999999999998,17.131999999999998,10.629999999999999,15.456999999999997,10.258999999999999C13.919999999999998,9.918,14.417999999999997,9.948999999999998,13.226999999999997,9.999999999999998C12.037999999999997,10.052999999999999,11.043999999999997,10.616999999999997,11.043999999999997,10.973999999999998C11.043999999999997,10.973999999999998,10.300999999999997,11.025999999999998,10.003999999999998,11.332999999999998C9.706,11.64,9.21,13.069,9.21,13.428C9.21,13.785,9.543000000000001,16.188000000000002,9.791,16.699L9.411,16.801000000000002C9.163,19.764000000000003,10.402,20.123,10.402,20.123C10.847,22.881,11.295,21.707,11.295,22.424C11.295,23.137,10.848,22.881,10.848,22.881S10.452,24.008,9.461,24.414C8.47,24.824,2.968,27.018,2.5200000000000005,27.48C2.071,27.941,2.122,30,2.122,30H25.719C25.719,30,25.768,27.941,25.323,27.48C24.873,27.018,19.373,24.824,18.379,24.414Z"
                                      transform="matrix(0.5,0,0,0.5,0,0)" stroke-width="0"
                                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                            </svg>
                        </i>
                        Sửa category
                    </h4>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('admin/catablog/'.$data->id).'/edit' }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                                {{ trans('Tên') }}</label>
                            <div class="col-sm-5">
                                <input class="form-control" placeholder="Category name" name="name" type="text"
                                       value="{{ $data->name }}">
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                                {{ trans('Mô tả') }}                       </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" placeholder="Category description"
                                          rows="3">{{ $data->description }}</textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">Featured image</label>
                            <div class="col-sm-10 fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-primary btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                     <input id="banner" name="banner" type="file">
                                </span>
                                <div class="fileupload-preview " style="max-width: 200px"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-danger" href="{{ url('admin/catablog/'.$data->id).'/edit' }}">
                                    Hủy </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </section>
@endsection
@push('scripts')
<script>

    @if($data->image)
    $(function(){
        $('.fileupload.fileupload-new').addClass('fileupload-exists').removeClass('fileupload-new');
        $('.fileupload-preview').html('');
        var img = '<img class="img-responsive thumbnail" src="{{ $data->image }}">';
        $('.fileupload-preview').append(img);
    });
    @endif



    //preview image before upload
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                $('.fileupload.fileupload-new').addClass('fileupload-exists').removeClass('fileupload-new');
                $('.fileupload-preview').html('');
                var img = '<img class="img-responsive thumbnail" src="' + e.target.result + '">';
                $('.fileupload-preview').append(img);
//                    $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#banner").change(function () {
        readURL(this);
    });
</script>
@endpush