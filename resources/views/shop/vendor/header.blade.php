<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src="/images/home/logo.png" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="/dashboard"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="/wishlist"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="/cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">login</a></li>
                            @else
                            <!-- User Account Menu -->
                                <li class=" user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       style="position: relative; padding-left: 50px;">
                                        <!-- The user image in the navbar-->
                                        <img src="{{Auth::user()->avatar}}"
                                             class="user-image img-responsive" alt="User Image"
                                             style="width:20px;height: 20px;border-radius: 50%; position: absolute;left: 10px; "/>
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        {{ Auth::user()->username }}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">

                                        <li><a href="{{ url('/home') }}"><i class="fa fa-btn fa-tachometer"></i>
                                                Dashboard </a></li>
                                        <li><a href="{{ url('/user/'.Auth::user()->id.'/edit/') }}"><i
                                                        class="fa fa-btn fa-user"></i> Profile </a></li>
                                        {{--<li class="user-header"><p>{{ Auth::user()->name }}</p></li>--}}
                                        <li>
                                            <a href="{{url('/logout')}}"
                                               onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><i
                                                        class="fa fa-btn fa-sign-out"></i>
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{url('/logout')}}" method="post"
                                                  style="display: none">
                                                {{csrf_field()}}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="index.html" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="{{url('cart')}}">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{url('/blog')}}">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('/blog/list')}}">Blog List</a></li>
                                    {{--<li><a href="{{url('/posts/{{$data}}">Blog Single</a></li>--}}
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->