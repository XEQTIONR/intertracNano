<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>intertracNano | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
{{--<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
<!-- Font Awesome -->
{{--<link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">--}}
<!-- Ionicons -->
{{--<link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">--}}
<!-- Theme style -->
    {{--<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">--}}

    <link rel="stylesheet" href="/css/app2.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.1/css/all.css">
    {{--<link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css'>--}}
  <!-- iCheck -->
{{--<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">--}}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>n</b>DB</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>nano</b>DB</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                {{--<li class="dropdown messages-menu">--}}
                {{--<!-- Menu toggle button -->--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="far fa-envelope"></i>--}}
                {{--<span class="label label-success">4</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">You have 4 messages</li>--}}
                {{--<li>--}}
                {{--<!-- inner menu: contains the messages -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- start message -->--}}
                {{--<a href="#">--}}
                {{--<div class="pull-left">--}}
                {{--<!-- User Image -->--}}
                {{--<img src="http://www.faidamarketlink.or.tz/faidamalimis/dist/img/user.png" class="img-circle" alt="User Image">--}}
                {{--</div>--}}
                {{--<!-- Message title and timestamp -->--}}
                {{--<h4>--}}
                {{--Support Team--}}
                {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                {{--</h4>--}}
                {{--<!-- The message -->--}}
                {{--<p>Why not buy a new awesome theme?</p>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<!-- end message -->--}}
                {{--</ul>--}}
                {{--<!-- /.menu -->--}}
                {{--</li>--}}
                {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                {{--<li class="dropdown notifications-menu">--}}
                {{--<!-- Menu toggle button -->--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="far fa-bell"></i>--}}
                {{--<span class="label label-warning">10</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">You have 10 notifications</li>--}}
                {{--<li>--}}
                {{--<!-- Inner Menu: contains the notifications -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- start notification -->--}}
                {{--<a href="#">--}}
                {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<!-- end notification -->--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="footer"><a href="#">View all</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <!-- Tasks Menu -->
                {{--<li class="dropdown tasks-menu">--}}
                {{--<!-- Menu Toggle Button -->--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="far fa-pennant"></i>--}}
                {{--<span class="label label-danger">9</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">You have 9 tasks</li>--}}
                {{--<li>--}}
                {{--<!-- Inner menu: contains the tasks -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- Task item -->--}}
                {{--<a href="#">--}}
                {{--<!-- Task title and progress text -->--}}
                {{--<h3>--}}
                {{--Design some buttons--}}
                {{--<small class="pull-right">20%</small>--}}
                {{--</h3>--}}
                {{--<!-- The progress bar -->--}}
                {{--<div class="progress xs">--}}
                {{--<!-- Change the css width attribute to simulate progress -->--}}
                {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"--}}
                {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">20% Complete</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<!-- end task item -->--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="footer">--}}
                {{--<a href="#">View all tasks</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="http://www.faidamarketlink.or.tz/faidamalimis/dist/img/user.png" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://www.faidamarketlink.or.tz/faidamalimis/dist/img/user.png" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::user()->name}}
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                        {{--<li class="user-body">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Followers</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Sales</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Friends</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.row -->--}}
                        {{--</li>--}}
                        <!-- Menu Footer-->
                            <li class="">
                                {{--<div class="pull-left">--}}
                                {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                {{--</div>--}}
                                <div class="">
                                    <a href="{{ route('logout') }}" class="btn btn-danger btn-flat btn-block"
                                       onclick="event.preventDefault();
                             document.getElementById('Logout-form').submit();">Sign out</a>
                                </div>

                                <form id="Logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{csrf_field()}}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://www.faidamarketlink.or.tz/faidamalimis/dist/img/user.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li><a href="#"><i class="fa fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li class="header">AVAILABLE OPTIONS</li>
                <!-- Optionally, you can add icons to the links -->
                {{--<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>--}}



                <li class="treeview
                  @if(stristr(Route::currentRouteName(), 'lcs'))
                    active
                  @endif
                ">
                    <a href="#"><i style="margin-left: 5px" class="far fa-file-invoice-dollar"></i> <span class="pl-3">Letters of Credit</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add a LC</a></li>
                        <li><a href="{{route('lcs.index')}}"><i class="fa fa-angle-right"></i>View LCs</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add a Proforma invoice</a></li>
                    </ul>
                </li>

              <li class="treeview
                  @if(stristr(Route::currentRouteName(), 'consignments'))
                    active
                  @endif
              ">
                      <a href="#"><i class="far fa-ship"></i> <span>Consignments</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{  route('consignments.index')  }}"><i class="fa fa-angle-right"></i>View consignments</a></li>
                      <li><a href="{{  route('consignment_containers.index'  )}}"><i class="fa fa-angle-right"></i>View containers</a></li>
                      <li><a href="#"><i class="fa fa-angle-right"></i>Add a consignment</a></li>
                      <li><a href="#"><i class="fa fa-angle-right"></i>Add a container</a></li>
                      <li><a href="#"><i class="fa fa-angle-right"></i>Add an expense</a></li>
                    </ul>
                </li>

                <li class="treeview
                    @if(stristr(Route::currentRouteName(), 'orders'))
                      active
                    @endif
                ">
                    <a href="#"><i class="fa fa-dolly"></i> <span>Orders</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{  route('orders.index')  }}"><i class="fa fa-angle-right"></i>View orders</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Create an order</a></li>
                    </ul>
                </li>

                <li class="treeview
                    @if(stristr(Route::currentRouteName(), 'payments'))
                      active
                    @endif
                ">
                    <a href="#"><i class="fa fa-hand-holding-usd"></i> <span>Payments</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{  route('payments.index')  }}"><i class="fa fa-angle-right"></i>View payments made</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Record a payment</a></li>
                    </ul>
                </li>

                <li class="treeview
                    @if(stristr(Route::currentRouteName(), 'tyres') || Route::currentRouteName() == 'stock')
                      active
                    @endif
                ">
                    <a href="#"><i class="fas fa-tire"></i> <span>Products</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{  route('tyres.index')  }}"><i class="fa fa-angle-right"></i>View tyre catalog</a></li>
                        <li><a href="{{  route('stock')  }}"><i class="fa fa-angle-right"></i>View current stock</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add a tyre</a></li>

                    </ul>
                </li>

                <li class="treeview
                    @if(stristr(Route::currentRouteName(), 'customers'))
                  active
                  @endif
                ">
                    <a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customers</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add a customer</a></li>
                        <li><a href="{{  route('customers.index')  }}"><i class="fa fa-angle-right"></i>View customers</a></li>
                    </ul>
                </li>

                <li class="treeview
                    @if(stristr(Route::currentRouteName(), 'reports'))
                      active
                    @endif
                ">
                    <a href="#"><i class="fas fa-chart-bar"></i> <span>Reports</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-right"></i>Order reports</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Payment reports</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Expenditure reports</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Outstanding Balance reports</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Profit/loss report</a></li>
                    </ul>
                </li>
                <li class="header">ADMIN ACTIONS</li>
                <li class="treeview">
                    <a href="#"><i class="far fa-user"></i> <span>Users</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-right"></i>View users</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add an user</a></li>
                    </ul>
                </li>

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('subtitle')</small>
            </h1>
            @yield('level')

        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            @yield('body')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
{{--<aside class="control-sidebar control-sidebar-dark">--}}
{{--<!-- Create the tabs -->--}}
{{--<ul class="nav nav-tabs nav-justified control-sidebar-tabs">--}}
{{--<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>--}}
{{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
{{--</ul>--}}
{{--<!-- Tab panes -->--}}
{{--<div class="tab-content">--}}
{{--<!-- Home tab content -->--}}
{{--<div class="tab-pane active" id="control-sidebar-home-tab">--}}
{{--<h3 class="control-sidebar-heading">Recent Activity</h3>--}}
{{--<ul class="control-sidebar-menu">--}}
{{--<li>--}}
{{--<a href="javascript:;">--}}
{{--<i class="menu-icon fa fa-birthday-cake bg-red"></i>--}}

{{--<div class="menu-info">--}}
{{--<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>--}}

{{--<p>Will be 23 on April 24th</p>--}}
{{--</div>--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<!-- /.control-sidebar-menu -->--}}

{{--<h3 class="control-sidebar-heading">Tasks Progress</h3>--}}
{{--<ul class="control-sidebar-menu">--}}
{{--<li>--}}
{{--<a href="javascript:;">--}}
{{--<h4 class="control-sidebar-subheading">--}}
{{--Custom Template Design--}}
{{--<span class="pull-right-container">--}}
{{--<span class="label label-danger pull-right">70%</span>--}}
{{--</span>--}}
{{--</h4>--}}

{{--<div class="progress progress-xxs">--}}
{{--<div class="progress-bar progress-bar-danger" style="width: 70%"></div>--}}
{{--</div>--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<!-- /.control-sidebar-menu -->--}}

{{--</div>--}}
{{--<!-- /.tab-pane -->--}}
{{--<!-- Stats tab content -->--}}
{{--<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>--}}
{{--<!-- /.tab-pane -->--}}
{{--<!-- Settings tab content -->--}}
{{--<div class="tab-pane" id="control-sidebar-settings-tab">--}}
{{--<form method="post">--}}
{{--<h3 class="control-sidebar-heading">General Settings</h3>--}}

{{--<div class="form-group">--}}
{{--<label class="control-sidebar-subheading">--}}
{{--Report panel usage--}}
{{--<input type="checkbox" class="pull-right" checked>--}}
{{--</label>--}}

{{--<p>--}}
{{--Some information about this general settings option--}}
{{--</p>--}}
{{--</div>--}}
{{--<!-- /.form-group -->--}}
{{--</form>--}}
{{--</div>--}}
{{--<!-- /.tab-pane -->--}}
{{--</div>--}}
{{--</aside>--}}
<!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
{{--<script src="node_modules/jquery/dist/jquery.min.js"></script>--}}
{{--<script src="js/jquery.min.js"></script>--}}

<!-- Bootstrap 3.3.7 -->
{{--<script src="~/bootstrap/dist/js/bootstrap.min.js"></script>--}}
{{--<script src="js/bootstrap.min.js"></script>--}}

<!-- AdminLTE App -->
{{--<script src="dist/js/adminlte.min.js"></script>--}}
{{--<script src="js/adminlte.min.js"></script>--}}
<script src="/js/app.js"></script>
{{--<script src="/js/jquery.inputmask.bundle.js"></script>--}}
{{--<script src='js/jquerydataTables.min.js'></script>--}}
{{--<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>--}}

<script>

    var target = document.querySelector('.content-wrapper');

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutationRecord) {
            $('.content-wrapper').css('min-height', '100vh');
        });
    });

    observer.observe(target, { attributes : true });

    $(document).ready(function() {
        $('#table_id').DataTable();
        $(".date").inputmask("dd/mm/yyyy");
        //  /Inputmask("dd/mm/yyyy").mask(document.querySelectorAll("input"));
    } );

    console.log("CURRENCY : " + currencies.BDT);
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>