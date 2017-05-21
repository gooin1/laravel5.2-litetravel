<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>轻游记</title>
    <!-- BaiduMap JS -->
     {{-- <script type="text/javascript" src="http://api.map.baidu.com/getscript?type=quick&file=api&ak=OjDVDaIyfqZGehQG2moe8nb9xvgoBWPp&t=20140109092002"></script> --}}
    
    <!-- Fonts -->
    <link href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://fonts.geekzu.org/css?family=Lato:100,300,400,700">
    
    <!-- Styles -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    {{-- footer css --}}
    <style>
        /* Sticky footer styles
        -------------------------------------------------- */
        #map {
            height: 500px;
        }
         #r-result {
            height: 500px;
            overflow: scroll;
        }
        

        #container{height:500px;width:100%;}
		#r-result{width:100%;}

        .footer {
      
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
        background-color: #f5f5f5;
        }

        /* Custom page CSS
        -------------------------------------------------- */
        /* Not required for template or sticky footer method. */

        .container .text-muted {
        margin: 20px 0;
        }

        .footer > .container {
        padding-right: 15px;
        padding-left: 15px;
        }

    </style>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    轻游记
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">精选游记</a></li>
                     @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登录查看我的</a></li>
                        
                    @else
                        <li><a>{{ Auth::user()->name }} 的记录</a></li>
                    @endif

                    <li><a href="{{ url('/map') }}">热力图</a></li>
                    <li><a href="{{ url('/road') }}">路线规划</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>注销</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        </div>
    </nav>

    @yield('content')

@section('footer')
  <footer class="footer">
      <div class="container">
        <p class="text-muted text-right">轻游记 Copyright ©2017 All rights Reserved </p>
      </div>
    </footer>
@show
    <!-- JavaScripts -->
    <script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    {{-- <script src="http://api.map.baidu.com/library/Heatmap/2.0/src/Heatmap_min.js"></script> --}}
    {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js"></script> --}}
    
    {{-- google basic map --}}
    {{-- @include('map.js.googlemap') --}}

    {{-- baidu basic map --}}
    {{-- @include('map.js.baidumapjs') --}}


    
    {{-- @include('map.js.googlehotmap') --}}
    {{-- @include('map.js.baiduhotmap') --}}
    
@yield('js')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
</body>
</html>
