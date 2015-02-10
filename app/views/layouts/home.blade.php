
<!DOCTYPE html>
<html lang="en">
    <head>
        @section('head')
        <meta charset="utf-8">
        <title>SMS Application -</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        {{ HTML::style('css/bootstrap.min.css'); }} 
        {{ HTML::style('css/bootstrap-responsive.min.css'); }} 

        {{ HTML::style('css/font-open-sans-400-600.css'); }} 
        {{ HTML::style('css/font-awesome.css'); }} 
        {{ HTML::style('css/style.css'); }} 
        {{ HTML::style('css/bootstrap-responsive.min.css'); }} 

        {{ HTML::style('css/pages/dashboard.css'); }} 

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        @show
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                            class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a>
                    <a class="brand" href="/sms">
                        SMS APP
                    </a>
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-cog"></i> Account <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/setting">Settings</a></li>
                                    <li><a href="/help">Help</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-user"></i> SMS Simulator<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/profile">Profile</a></li>
                                    <li><a href="/?logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-search pull-right">
                            <input type="text" class="search-query" placeholder="Search">
                        </form>
                    </div>
                    <!--/.nav-collapse --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /navbar-inner --> 
        </div>
        <!-- /navbar -->
        <div class="subnavbar">
            <div class="subnavbar-inner">
                <div class="container">
                    <ul class="mainnav">

                        <li class="">
                            <a href="{{url('/')}}"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
                        <li class="">
                            <a href="{{url('apps')}}"><i class="icon-dashboard"></i><span>Applications</span> </a> </li>
                        <li class="">
                            <a href="{{url('sms')}}"><i class="icon-dashboard"></i><span>SMS</span> </a> </li>

                        <li class="">
                            <a href="{{url('appusers')}}"><i class="icon-dashboard"></i><span>Users</span> </a> </li>

                    </ul>
                </div>
                <!-- /container --> 
            </div>
            <!-- /subnavbar-inner --> 
        </div>
        <!-- /subnavbar -->

        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">


                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                            @endif
                            <!-- Main content -->
                            @yield('content')  


                        </div>
                        <!-- /span6 --> 
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /main-inner --> 
        </div>

        <!-- /main -->
        <!-- /extra -->
        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12"> &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>. </div>
                        <!-- /span12 --> 
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /footer-inner --> 
        </div>
        <!-- /footer --> 
        <!-- /footer --> 
        <!-- Le javascript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        {{ HTML::script('js/jquery-ui-1.10.3.min.js'); }}
        <!-- Bootstrap -->
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/excanvas.min.js'); }}
        {{ HTML::script('js/chart.min.js'); }}
        {{ HTML::script('js/base.js'); }}
        {{ HTML::script('js/datepicker/bootstrap-datepicker.js'); }}
        {{ HTML::script('js/highchart/highcharts.js'); }}
        {{ HTML::script('js/highchart/data.js'); }}

        {{ HTML::script('js/highchart/drilldown.js'); }}

        @yield('script')
    </body>
</html>
