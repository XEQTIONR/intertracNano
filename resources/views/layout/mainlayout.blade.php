<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Intertrac Nano</title>

<!-- Fonts -->
<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,400,700" rel="stylesheet" type="text/css">-->
<link href="https://fonts.googleapis.com/css?family=Raleway:400,600,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,700" rel="stylesheet">
<!-- Styles -->
<link href="/css/app.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/css/jquery-ui.css" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

<link href="/css/app.css" rel="stylesheet" type="text/css">

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="/js/main_menu.js"></script>
@yield('scripts')

</head>


<body>



  <nav id="navMain" class="navbar nav-topmost navbar-fixed-top">
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
          {{ config('app.name', 'Laravel') }}
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          &nbsp;
        </ul>

        <!-- Right Side Of Navbar -->
        <ul  class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li id="NavBootstrapOverride"><a href="{{ route('login') }}">Login</a></li>

          @else
            <li id="NavBootstrapOverride" class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">

                @if(Auth::user()->admin)
                  <li>
                    <span>Admin Actions</span>
                  </li>
                  <li><a href="{{ route('register') }}">Register</a></li>

                  <hr>
                @endif
                <li>
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @if(Auth::check())
    @include('partials.maintabsmenu')
  {{--  @include('partials.mainmenu') --}}
  @endif


<div id="mainContent">

  @yield('content')

</div>

@include('partials.footer')


<!-- Latest compiled and minified JavaScript -->

</body>
</html>
