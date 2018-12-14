<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Admin Page</title>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="{{asset('css/admin/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/admin/bootstrap-multiselect.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/ace.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/admin/jquery.datetimepicker.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/ace-skins.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/admin/ace-rtl.min.css')}}" />
        <link href="{{asset('css/admin/style1.css')}}" rel="stylesheet">	
        <script>
            var GlobleVariable = [];
            GlobleVariable.app_url = "<?php echo env('APP_URL'); ?>";
        </script>   
        <script type="text/javascript" src="{{asset('js/admin/myscript.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="{{asset('js/admin/jquery.datetimepicker.full.js')}}"></script>
        <script src="{{asset('js/admin/prettify.min.js')}}"></script>
        <script src="{{asset('js/admin/bootstrap-multiselect.js')}}"></script>
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">Home                  
                        <small>
                            <i class="fa fa-leaf"></i>
                            Event Tommorow
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <ul class="nav navbar-nav navbar-right">
                        @guest
                        <li><a href="#"><b>Đăng nhập/Đăng kí</b></a></li>                           
                        @else
                            <li class="dropdown">
                               <button class="dropbtn">{{ Auth::user()->username}}<span class="caret"></span></button>
                                    <div class="dropdown-content">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        </form>
                                    </div>
                            </li>
                        @endguest
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('admin/contacts')}}"><b>Liên hệ</b></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><b>Đổi thông tin tài khoản</b></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('admin/contacts')}}"><b>Liên hệ</b></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><b>Thống kê người dùng</b></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><b>Thống kê bán vé</b></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><b>Thống kê sự kiện</b></a></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            @include('layouts.admin.menu-bar')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Trang chủ</a>
                            </li>
                            <!-- <li class="active">Dashboard</li> -->
                        </ul>

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <span class="blue bolder">IAU</span>
                        PNV - Events Management project Laravel - 2018
                    </span>

                    &nbsp; &nbsp;
                    <span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
    <script src="{{asset('js/admin/jquery-2.1.4.min.js')}}"></script>

    <script type="text/javascript">
                    if ('ontouchstart' in document.documentElement)
                        document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin/ace.min.js')}}"></script>
</body>
</html>