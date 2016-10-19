@extends('shop.layouts.app')

@section('title','Product-detail')

@section('slider')
    @include('shop.vendor.home-slider')

@endsection
@section('content')
    @include('shop.vendor.left-sidebar')

    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="../images/{{$product_detail->getImageFeature()}}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($product_detail->getAllImage() as $image)
                        <div class="item active col-sm-4">
                            <a href=""><img src="../images/{{$image}}" alt=""></a>
                        </div>
                            @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="../images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $product_detail->product_name }}</h2>
                    <p>Web ID: {{ $product_detail->id }}</p>
                    <img src="../images/product-details/rating.png" alt="" /><br>
								<span>
									<span>{{number_format($product_detail->price,0,",",".")}} VNĐ</span>
									{{--<label>Quantity:</label>--}}{{--                   // bo sung sau--}}
									{{--<input type="text" value="3" />--}}
									<a href="{{url('cart')}}"> <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button></a>
								</span>
                    <p><b>Availability:</b>
                        @if ($product_detail->status == 1)
                            {{ 'Visible' }}
                        @else
                            {{ "Invisible" }}

                    @endif</p>
                    {{--<p><b>Condition:</b> New</p>--}}{{--    // bo sung sau--}}
                    <p><b>Brand: </b>{{ $product_detail->brand}} </p>
                    <a href=""><img src="../images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    {{$product_detail->description}}
                                </div>
                            </div>
                        </div>
                </div>

                {{--<div class="tab-pane fade" id="companyprofile" >--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery1.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery3.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery2.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery4.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="tab-pane fade" id="tag" >--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery1.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery2.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery3.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-3">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/gallery4.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="tab-pane fade active in" id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>{{$product_detail->updated_at}}</a></li>
                        </ul>
                        <p></p>{{$product_detail->review}}</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="../images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

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
                                                <img style="height:268px;" src="../images/{{$item->getImageFeature()}}"
                                                     alt="{{$item->product_name}}"/>
                                                <h2>{{ number_format($item->price) }} VND</h2>
                                                <p>{{$item->product_name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
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
