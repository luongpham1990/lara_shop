@extends('admin.layouts.app')

@section('htmlheader_title','Edit Cateblog')

@section('contentheader_title','Cateblog')
@section('contentheader_description','Chỉnh sửa Cateblog')

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

                        </i>
                        Edit Cateblog
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
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-2">Featured image</label>--}}
                            {{--<div class="col-sm-10 fileupload fileupload-new" data-provides="fileupload">--}}
                                {{--<span class="btn btn-primary btn-file">--}}
                                    {{--<span class="fileupload-new">Select file</span>--}}
                                    {{--<span class="fileupload-exists">Change</span>--}}
                                     {{--<input id="banner" name="banner" type="file">--}}
                                {{--</span>--}}
                                {{--<div class="fileupload-preview " style="max-width: 200px"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
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

    {{--@if($data->image)--}}
    {{--$(function(){--}}
        {{--$('.fileupload.fileupload-new').addClass('fileupload-exists').removeClass('fileupload-new');--}}
        {{--$('.fileupload-preview').html('');--}}
        {{--var img = '<img class="img-responsive thumbnail" src="{{ $data->image }}">';--}}
        {{--$('.fileupload-preview').append(img);--}}
    {{--});--}}
    {{--@endif--}}



    //preview image before upload
//    function readURL(input) {
//
//        if (input.files && input.files[0]) {
//            var reader = new FileReader();
//
//            reader.onload = function (e) {
//
//                $('.fileupload.fileupload-new').addClass('fileupload-exists').removeClass('fileupload-new');
//                $('.fileupload-preview').html('');
//                var img = '<img class="img-responsive thumbnail" src="' + e.target.result + '">';
//                $('.fileupload-preview').append(img);
////                    $('#blah').attr('src', e.target.result);
//            };
//
//            reader.readAsDataURL(input.files[0]);
//        }
//    }

//    $("#banner").change(function () {
//        readURL(this);
//    });
</script>
@endpush