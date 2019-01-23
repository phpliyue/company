<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('css')
        <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    @show
    <title>@yield('title')</title>
</head>
<body class="pace-done">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="@yield('nav0')">
                    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">首页</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        {{--<li class="@yield('navli0')"><a href="{{url('admin_index')}}">管理员首页</a></li>--}}
                        {{--<li class="@yield('navli0')"><a href="{{url('admin_index')}}">社区首页</a></li>--}}
                        {{--<li class="@yield('navli0')"><a href="{{url('admin_index')}}">商家首页</a></li>--}}
                        <li class="@yield('navli0')"><a href="{{url('admin_index')}}">旅游首页</a></li>
                    </ul>
                </li>
                {{--<li>--}}
                    {{--<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">新闻管理</span> <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li><a href="index.html">新闻列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">账号管理</span> <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li><a href="index.html">人员列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--商品管理--}}
                {{--<li class="@yield('nav1')">--}}
                    {{--<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">商品管理</span> <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level collapse">--}}
                        {{--<li class="@yield('navli10')"><a href="{{url('shop_goods')}}">商品列表</a></li>--}}
                        {{--<li class="@yield('navli11')"><a href="{{url('shop_cate')}}">类目列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="@yield('nav2')">--}}
                    {{--<a href=""><i class="fa fa-th-large"></i> <span class="nav-label">订单管理</span> <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level collapse">--}}
                        {{--<li class="@yield('navli20')"><a href="{{url('shop_goods')}}">订单列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href=""><i class="fa fa-th-large"></i> <span class="nav-label">账号管理</span> <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level collapse">--}}
                        {{--<li><a href="{{url('shop_goods')}}">人员管理</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--旅游管理--}}
                <li class="@yield('nav1')">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">商品管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="@yield('navli10')"><a href="{{url('shop_goods')}}">商品列表</a></li>
                        <li class="@yield('navli11')"><a href="{{url('shop_cate')}}">类目列表</a></li>
                    </ul>
                </li>
                <li class="@yield('nav2')">
                    <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">订单管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="@yield('navli20')"><a href="{{url('shop_goods')}}">订单列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">账号管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{url('shop_goods')}}">人员管理</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{url('logout')}}">
                            <i class="fa fa-sign-out"></i> 退出
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @section('content')
        @show
    </div>
</div>
</body>
@section('js')
    <script src="{{URL::asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{URL::asset('js/inspinia.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@show
</html>