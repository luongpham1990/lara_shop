@extends('admin.layouts.app')
@section('htmlheader_title','Create Post')

@section('contentheader_title','Post')
@section('contentheader_description','Tạo mới Post')
{{--@section('contentheader_description','Add one post')--}}

@push('links')
<link href="/plugins/summernote/summernote.css" type="text/css" rel="stylesheet">
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
        <!--main content-->
        <div class="row">
            <!-- errors -->
            <div class="has-error">
                @if(count($errors))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @foreach( $errors->all() as $item)
                            <li> {{ $item }}  </li>
                        @endforeach
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
                            Create Post
                        </h4>
                    </div>
                    <br>
                    <div class="panel-body">
                        <form id="form_post" method="POST" action="{{ url('/admin/post/add') }}" accept-charset="UTF-8"
                              class="bf"
                              enctype="multipart/form-data" runat="server">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input class="form-control input-lg" required="required"
                                               placeholder="Post title here..." name="title" type="text">
                                    </div>
                                    <div class="box-body pad">
                                        <textarea class="form-control" placeholder="Post description" id="summernote"
                                                  name="content"></textarea>
                                    </div>
                                </div>
                                <!-- /.col-sm-8 -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="blog_category_id">Post category</label>
                                        <select class="form-control select2" id="blog_category_id" name="category">
                                            <option selected="selected" value="">Select a Category</option>
                                            @foreach($data as $cateblog)
                                                <option value="{{$cateblog->id}}"> {{ $cateblog->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="bootstrap-tagsinput"><input type="text" placeholder="Tags..."></div>
                                        <input class="form-control input-lg" data-role="tagsinput" placeholder="Tags..."
                                               name="tags" type="text" style="display: none;">
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Luu</button>
                                        <a href="" type="reset" class="btn btn-danger">Huy</a>
                                    </div>
                                    <div>
                                        {{csrf_field()}}
                                        <strong style="font-size: 20px">Featured image: </strong><br/><br/>
                                        <div class="form-group">
                                            <label>Featured image</label>
                                            <div id="wrapper" style="margin-top: 10px;"><input id="fileUpload"
                                                                                               multiple="multiple"
                                                                                               type="file"
                                                                                               name="banner"/>
                                                <div id="image-holder"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-sm-4 -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--main content ends-->
        </div>
    </section>

@endsection

@push('scripts')
<script src="/plugins/summernote/summernote.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('#summernote').summernote({

            callbacks: {
                onImageUpload: function (files, editor, $editable) {
//                    alert('evoked');
                    sendFile(files[0], editor, $editable);
                }
            },
            placeholder: 'write here...',
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,  // set auto focus
            disableDragAndDrop: false  // enable drag and drop
        });

        function sendFile(file, editor, welEditable) {

            data = new FormData();
            data.append("file", file);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url(route('post_upload_image')) }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
//                    alert(data);
                    console.log(data);
                    $('#summernote').summernote("insertImage", data.data, 'filename');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        }


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
    });


</script>
<script>
    $(document).ready(function () {
        $("#fileUpload").on('change', function () {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-holder");
            image_holder.empty();
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-responsive"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        });
    });

</script>

@endpush