@extends('sites.layouts.app')
@section('title','Detail')

@section('main-content')
        <!-- Page Header -->


        {{--{{dd($data->cateblog)}}--}}
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url( {{$data->banner}} )">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>{{ $data->title }}</h1>
                    <h2 class="subheading">{{ substr(strip_tags($data->body),0,100) }}</h2>
                    <span class="meta">Đăng bởi <a
                                href="#">{{ $data->user->username }}</a> trong {{ $data->cateblog->name }}  {{ $data->created_at }}</span>
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
                {!! $data->body !!}
            </div>
        </div>
    </div>
</article>

<hr>

{{--comment field--}}

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-comment">
                <h3 class="text-success">Comments</h3>
                <hr/>
                <ul class="comments">
                    @if($data->comments->first())
                        @foreach($data->comments->sortByDesc( function($comment){
                        return $comment->created_at;
                        }) as $comment)
                            <li class="clearfix">
                                <img src="{{$comment->user->avatar_link}}" class="avatar" alt="">
                                <div class="post-comments">
                                    <p class="meta">{{ $comment->created_at }} <a
                                                href="#">{{ $comment->user->name }}</a> says : <i class="pull-right"><a
                                                    href="#">
                                                <small>Reply</small>
                                            </a></i></p>
                                    <p>
                                        {{ $comment->body }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
{{--end comment field--}}
<section class="comment-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h3>{{ trans('adminlte_lang::message.dropus') }}</h3>
                <br>
                <form role="form" action="" method="post"
                      {{--{{ route('comment.store', ['post' => $data->id]) }}--}}
                      enctype="plain">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Nội dung</label>
                    <span class="help-block"
                          style="color: white;">{{ $errors->has('body') ? $errors->first('body') : '' }}</span>
                        <textarea class="form-control" name="body" rows="3"></textarea>
                    </div>
                    <br>
                    <button type="submit"
                            class="btn btn-large btn-success">{{ trans('adminlte_lang::message.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('links')
<style>

    body {
        background: #eee;
    }

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #FFFFFF;
    }

    a {
        color: #82b440;
        text-decoration: none;
    }

    .blog-comment::before,
    .blog-comment::after,
    .blog-comment-form::before,
    .blog-comment-form::after {
        content: "";
        display: table;
        clear: both;
    }

    .blog-comment {
        padding-left: 15%;
        padding-right: 15%;
    }

    .blog-comment ul {
        list-style-type: none;
        padding: 0;
    }

    .blog-comment img {
        opacity: 1;
        filter: Alpha(opacity=100);
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
    }

    .blog-comment img.avatar {
        position: relative;
        float: left;
        margin-left: 0;
        margin-top: 0;
        width: 65px;
        height: 65px;
    }

    .blog-comment .post-comments {
        border: 1px solid #eee;
        margin-bottom: 20px;
        margin-left: 85px;
        margin-right: 0px;
        padding: 10px 20px;
        position: relative;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        background: #fff;
        color: #6b6e80;
        position: relative;
    }

    .blog-comment .meta {
        font-size: 13px;
        color: #aaaaaa;
        padding-bottom: 8px;
        margin-bottom: 10px !important;
        border-bottom: 1px solid #eee;
    }

    .blog-comment ul.comments ul {
        list-style-type: none;
        padding: 0;
        margin-left: 85px;
    }

    .blog-comment-form {
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 40px;
    }

    .blog-comment h3,
    .blog-comment-form h3 {
        margin-bottom: 40px;
        font-size: 26px;
        line-height: 30px;
        font-weight: 800;
    }
</style>
@endpush