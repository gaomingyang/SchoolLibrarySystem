<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo App\System::system_name()?></title>

    <!-- Fonts -->
   <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->

    <!-- Styles -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css" >
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-theme.css" >
    <link rel="stylesheet" type="text/css" href="/css/admin.css" >
    <style>
        body {
          /*min-height: 2000px;*/
          padding-top: 70px;
        }

    </style>
    @yield('css')
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-fixed-top ">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/admin') }}"><?php echo App\System::system_name()?></a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li ><a href="/">回到前台</a></li>
                    <!--<li class="active"><a href="/">主页</a></li>
                    <li ><a href="/admin/book">图书</a></li>
                    <li ><a href="/admin/borrow">借还</a></li>
                    <li><a href="/admin/students">学生</a></li> -->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/admin/login') }}">{{ trans('common.login')}}</a></li>
                        <li><a href="{{ url('/admin/register') }}">{{ trans('common.register')}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="">{{ trans('common.changePassword')}}</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('common.logout')}}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>



<div class="container-fluid">
  <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar"> <!--图书-->
                <!-- <li class="disabled"><a href="#">图书</a></li> -->
                <li class=""><a href="/admin/book">图书列表</a></li>
                <li><a href="/admin/book/create">增加图书</a></li>
                <li ><a href="/admin/category">图书分类</a></li>
                <li ><a href="/admin/tag">图书标签</a></li>
           </ul>
           <ul class="nav nav-sidebar">
               <li><a href="/admin/borrowed">借出书单</a></li>
               <li><a href="/admin/returned">已还书单</a></li>
               <li><a href="/admin/borrowlog">借书记录</a></li>
           </ul>
           <ul class="nav nav-sidebar">
               <li><a href="/admin/grade">班级管理</a></li>
               <li><a href="/admin/student">学生列表</a></li>
           </ul>
           <ul class="nav nav-sidebar">
               <li><a href="/admin/system">系统设置</a></li>
               <li><a href="/admin/user">账号管理</a></li>
           </ul>

        </div>

        <div class="col-xs-10 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>

    </div>
</div>
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    @yield('js')
</body>
</html>
