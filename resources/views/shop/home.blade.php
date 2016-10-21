@extends('shop.layouts.app')

@section('slider')
    @include('shop.vendor.home-slider')

@endsection
@section('content')

    @include('shop.vendor.left-sidebar')

    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('products/'.$product->id)}}">
                                <img src="images/{{$product->getImageFeature()}}" alt=""/>
                                <h2> {{number_format($product->price,0,",",".")}} VNĐ</h2>
                                <p>{{ $product->product_name }}</p>
                                {{--<form method="POST" action="{{url('cart',[$product->id])}}">--}}
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{url('mua-hang',[$product->id])}}"><button type="submit" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button></a>
                                {{--</form>--}}
                                </a>
                            </div>
                            {{--<div class="product-overlay">--}}
                                {{--<div class="overlay-content">--}}
                                    {{--<a href="{{url('products/'.$product->id)}}">--}}
                                        {{--<h2>{{number_format($product->price,0,",",".")}} VNĐ</h2>--}}
                                        {{--<p>{{ $product->product_name }}</p></a>--}}
                                    {{--<form method="POST">--}}
                                        {{--<input type="hidden" name="product_id" value="{{$product->id}}">--}}
                                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                        {{--<a href="{{url('mua-hang',[$product->id])}}"><button type="submit" class="btn btn-default add-to-cart">--}}
                                            {{--<i class="fa fa-shopping-cart"></i>--}}
                                            {{--Add to cart--}}
                                        {{--</button></a>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            @endforeach
            {{--<div class="col-xs-12"> {{ $products->links() }}</div>--}}
        </div><!--features_items-->

        <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    @foreach($categories as $category)
                        <li class="{{ $categories->first() == $category ? 'active' : '' }}"><a
                                    href="#{{str_slug($category->catalog_name)}}"
                                    data-toggle="tab">{{ $category->catalog_name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content">
                @foreach($categories as $category)
                    {{--voi moi 1 category thi ta se in ra san pham tieu bieu cua no--}}

                    <div class="tab-pane fade {{ $categories->first() == $category ? 'active' : '' }} in"
                         id="{{ str_slug($category->catalog_name) }}">
                        @foreach($category->getFeatureProducts() as $featureProduct)
                            <div class="col-sm-2" style="margin: 2.5%">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('products/'.$product->id)}}">
                                                <img src="images/{{$featureProduct->getImageFeature()}}" alt=""/>
                                                <h2>{{number_format($product->price,0,",",".")}} VNĐ</h2>
                                                <p>{{ $featureProduct->product_name }}</p> </a>
                                            {{--<form method="POST" action="{{url('cart/'.$product->id)}}">--}}
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <a href="{{url('mua-hang',[$product->id])}}"><button type="submit" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </button></a>
                                            {{--</form>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach( $recommend_products as $catalog)
                        <div class="item {{ $loop->first ?'active': ''  }}">

                            {{--begin foreach--}}
                            @foreach($catalog as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/{{$item->getImageFeature()}}"
                                                     alt="{{$item->product_name}}"/>
                                                <h2>{{number_format($item->price,0,",",".")}} VND</h2>
                                                <p>{{$item->product_name}}</p>
                                                {{--<form method="POST" action="{{url('cart/'.$product->id)}}">--}}
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <a href="{{url('mua-hang',[$product->id])}}"><button type="submit" class="btn btn-default add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        Add to cart
                                                    </button></a>
                                                {{--</form>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            {{--endforeach--}}
                        </div>
                    @endforeach
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->

    </div>

@endsection