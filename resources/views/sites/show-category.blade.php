@extends('sites.layouts.app')


@section('main-content')


        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('{{ url($category->image) }}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>{{ $category->name }}</h1>
                    <hr class="small">
                    <span class="subheading">Một cái category cua blog của nghĩa</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @foreach($data as $item)

                <div class="post-preview">
                    <a href="{{ url('/posts/'.$item->id) }}">
                        <h2 class="post-title">
                            {{ $item->title }}
                        </h2>
                        <h3 class="post-subtitle">


                            {{ substr(strip_tags($item->body),0,100) }}
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">{{ $item->user->name}}</a> {{ $item->created_at }}</p>
                </div>
                <hr>

                @endforeach
                        <!-- Pager -->
                {{ $data->links('vendor.pagination.site') }}
        </div>
    </div>

</div>


@endsection
@push('scripts')
<script>

    //preview image before upload
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                $('.fileupload.fileupload-new').addClass('fileupload-exists').removeClass('fileupload-new');
                $('.fileupload-preview').html('');
                var img = '<img class="img-responsive thumbnail" src="'+ e.target.result+'">';
                $('.fileupload-preview').append(img);
//                    $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#banner").change(function(){
        readURL(this);
    });
</script>
@endpush
