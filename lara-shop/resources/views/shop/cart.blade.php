@extends('shop.layouts.app')

@section('title','Cart')

@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <form method="POST" action="">
                        <input name="_token" type="hidden" value="{{csrf_token()}}"/>
                    @foreach($content as $item)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="/images/{{$item->options->img}}" style="width: 110px" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item->name}}</a></h4>
                                <p>Web ID: {{$item->id}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($item->price,0,",",".")}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href='{{url("cart?product_id=$item->id&increment=1")}}'> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}"
                                           autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href='{{url("cart?product_id=$item->id&decrease=1")}}'> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($item->price*$item->qty,0,",",".")}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url ('xoa-san-pham',['id'=>$item->rowId])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </form>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                {{--<tr class="shipping-cost">--}}
                                    {{--<td>Shipping Cost</td>--}}
                                    {{--<td>Free</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <td>Total</td>
                                    <td><span>{{$total}}</span></td>
                                </tr>
                            </table>
                            <a class="btn btn-default update" href="{{url('xoa-cart')}}">Clear Cart</a>
                            <a class="btn btn-default check_out" href="{{url('checkout')}}">Check Out</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    {{--<section id="do_action">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-6">--}}
                    {{----}}
                {{--</div>--}}
                {{--<div class="col-sm-6">--}}
                    {{--<div class="total_area">--}}
                        {{--<ul>--}}
                            {{--<li>Shipping Cost <span>Free</span></li>--}}
                            {{--<li>Total <span>${{Cart::total()}}</span></li>--}}
                        {{--</ul>--}}
                        {{--<a class="btn btn-default update" href="{{url('clear-cart')}}">Clear Cart</a>--}}
                        {{--<a class="btn btn-default check_out" href="{{url('checkout')}}">Check Out</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section><!--/#do_action-->--}}

@endsection

<script>
    $(document).ready(function () {
        $(".cart_quantity_delete").click(function () {
            alert(111)
        })
    })

</script>
