<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="图书管理系统">
        <title><?php echo App\System::front_name()?></title>
        <link rel="stylesheet" type="text/css" href="/css/front.css" >
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css" >
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-theme.css" >
        <style>
            body {
              padding-top: 70px;
            }
            }
            .jumbotron {
              text-align: center;
              background-color: transparent;
            }

        </style>
        @yield('css')

    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/"><?php echo App\System::front_name()?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li ><a href="/book">图书</a></li>
                <li ><a href="/borrow/create">借书</a></li>
                <li ><a href="/return">还书</a></li>
              </ul>
              <form action="{{URL('/search')}}" method="POST" class="navbar-form navbar-left" role="search">
                <div class="form-group ">
                  <input type="text" class="form-control" name="keyword" placeholder="书名/编号/学生名" value="{{isset($keyword) ? $keyword : ''}}">
                </div>

                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 搜索</button>
              </form>

              <ul class="nav navbar-nav ">
                  <li><a href="/borrowed">已借出</a></li>
                  <li><a href="/returned/today">已归还</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin">管理</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        @yield('content')

        <!-- <div class="container">

            <footer class="footer">
                <p>&copy; 2016 大顺小学, Inc.</p>
            </footer>
        </div>  -->

    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    @yield('js')
    </body>
</html>
