@extends('sites.layouts.app')


@section('main-content')


        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('{{ url('site/img/home-bg.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Eshoper's Blog</h1>
                    <hr class="small">
                    <span class="subheading">Một cái blog </span>
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
<div id="footerwrap">
    <div class="container">
        <div class="col-lg-5">
            <h3>{{ trans('adminlte_lang::message.address') }}</h3>
            <p>
                Av. Greenville 987,<br/>
                New York,<br/>
                90873<br/>
                United States
            </p>
        </div>

        <div class="col-lg-7">
            <h3>{{ trans('adminlte_lang::message.dropus') }}</h3>
            <br>
            <form role="form" action="{{ route('tickets.store') }}" method="post" enctype="plain">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name1">{{ trans('adminlte_lang::message.yourname') }}</label>
                    <input type="text" name="name" class="form-control" id="name1"
                           placeholder="{{ trans('adminlte_lang::message.yourname') }}">
                    <span class="help-block"
                          style="color: white;">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="email1">{{ trans('adminlte_lang::message.emailaddress') }}</label>
                    <input type="email" name="email" class="form-control" id="email1"
                           placeholder="{{ trans('adminlte_lang::message.enteremail') }}">
                    <span class="help-block"
                          style="color: white;">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('adminlte_lang::message.yourtext') }}</label>
                    <span class="help-block"
                          style="color: white;">{{ $errors->has('content') ? $errors->first('content') : '' }}</span>
                    <textarea class="form-control" name="content" rows="3"></textarea>
                </div>
                <br>
                <button type="submit"
                        class="btn btn-large btn-success">{{ trans('adminlte_lang::message.submit') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('links')
<style>

    #footerwrap {
        background-color: #2f2f2f;
        color: white;
        padding-top: 40px;
        padding-bottom: 60px;
        text-align: left;
    }

    #footerwrap h3 {
        font-size: 28px;
        color: white;
    }

    #footerwrap p {
        color: white;
        font-size: 18px;
    }

</style>
@endpush