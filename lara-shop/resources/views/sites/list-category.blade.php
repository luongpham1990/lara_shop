@extends('sites.layouts.app')
@section('title','Detail')

@section('main-content')
        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url({{url('site/img/home-bg.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>Danh sách category</h1>
                    <h2 class="subheading">Danh sách Category của sản phẩm</h2>
                    {{--<span class="meta">Đăng bởi <a href="#">{{ $data->user->name }}</a> trong {{ $data->category->name }}  {{ $data->created_at }}</span>--}}
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <h3 class="title">
                    Category list <span class="badge">{{ $data->count() }}</span>
                </h3>
                <ul class="list-group">
                    @foreach($data as $item)
                    <li class="list-group-item"><a href="{{ url('/categories/'.$item->id) }}">{{ $item->name }}  </a> <span class="badge">{{ $item->posts->count() }}</span></li>
                    @endforeach
                </ul>

                {{ $data->links('vendor.pagination.site') }}
            </div>
        </div>
    </div>
</article>

<hr>
@endsection