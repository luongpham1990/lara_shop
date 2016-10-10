<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('/admin/user/list')}}">Admin Area</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

            @if(Auth::guest())
                <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
            @else
                <li>

                    <a class=" dropdown-toggle" data-toggle="dropdown"> {{Auth::user()->username}}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{{ url('/admin/edit/'.Auth::user()->id) }}"> Dashboard </a> </li>
                        <li>
                            <a href="{{url('/logout')}}"
                               onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
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
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="{{ url('/admin/'.Auth::user()->id .'/edit') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{url('/admin/cata/list')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin/cata/list')}}">List Category</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/cata/add')}}">Add Category</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{url('/admin/product/list')}}"><i class="fa fa-cube fa-fw"></i> Product<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin/product/list')}}">List Product</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/product/add')}}">Add Product</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{url('/admin/user')}}"><i class="fa fa-users fa-fw"></i> User<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin/user/')}}">List User</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/user/add')}}">Add User</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>