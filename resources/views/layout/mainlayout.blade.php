<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Intertrac Nano</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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

<div class="flex-center position-ref full-height">
<!--@if (Route::has('login'))
  <div class="top-right links">
  @if (Auth::check())
    <a href="{{ url('/home') }}">Home</a>
  @else
    <a href="{{ url('/login') }}">Login</a>
    <a href="{{ url('/register') }}">Register</a>
  @endif
  </div>
@endif-->

<div id="app">
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
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                              @if(Auth::user()->admin)
                                <li>
                                    I AM AN ADMIN YAY  
                                </li>
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

</div>

<div class="container-fluid">

  <div class="row">

  <div class="col-md-2 col-md-push-5">
    <h1 class="main-title text-center">nanoDB</h1>
  </div>

  </div> <!--row-->


  <div class="row">

  <div class="col-md-4 col-md-push-4" >
    <table style="margin-left: auto; margin-right: auto;">
    <tr>
      <td class="menu-table-cell">
        <!-- Bar Chart icon by Icons8 -->
        <img class="icon icons8-Bar-Chart centered" width="50" height="50" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAA1UlEQVRoQ+2ZWw6AIAwE9f6H1kQh4iMEuiU2ZPwWcLs7gLAukzzrJDoWhERzMpIjm7E4hwaEGKtXa5YdaS3u7f3WRgO++9UlQqIy0poSojWaExiBkUEZI1rTRkvatDnEzS1a0wkxrawRHUGI6Io7IziCI2cFiNZzZZcqIsYKR/JJUDlDqY6oOwNpfIR8zDJSRSPNWghJM55UiBGMWLc4CPFeEKWKAnu6GoER1pFrd/lkSmKMaBEtolW/c4QRGIGRfkZ6D0QyZ17/7Kbxv2A3dVQw80v7HX6EvjPxvEFEAAAAAElFTkSuQmCC">
      </td>

      <td class="menu-table-cell">
        <!-- Visible icon by Icons8 -->
        <img class="icon icons8-Visible centered" width="50" height="50" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAD2ElEQVRoQ+3Zi5HURhAG4L4IIAQTARCBfREAEdiOADsC7AhsIgAiACKwicAQAQ4BIoD6KPVV3+yMVrtCBXWlqdpCexr19P/onllxETdkXNwQHLED+d6U3BXZFdmIgd1aGxF7dthdkbOp2+jBXZEOsbcj4seIuBcRP0WE767reBsRHyLi34hw/Wb6vlqntYpI9kFEPJw+5yT0KiJ8Xq8BdS6QHyLicUT8MjGfADCMbR/MY70OCnk2VaNgDvOfR8TTiPj/VEZOBUKBJxHxW7PQnxHx9xmMiieWmHWIJSZwi8YpQCjwR6OARViCtdYM1mLRjxFxawoEhPUodHQsAcIKz6YCFpB9MPZyin5nYAXggFf4Brth2b/tsMb76Y+PJpXSdub/esxux4Cogb8mFbDFBnzs78C9mK7bxNwzpzeAwXQ7xP15Sto1IvxLIer8Pn3vBp0DUpNhH4mlZ9MKmLJYHRJItUaWuOwok+RQPFVUQ+KzneHamgejB8TDEslgmGClOshN+p6t8t4IhL/XZHOeTvbf4B4ncIYhPvtdawQtECD+mdojK2G35+lPU9AeEXlvDoh7c8/27gEqF1bT1ql6BaY+YCIlFN67yUrtPpDJfQsg1pYje91twSQQSpA1QbDVXA8HULD7nU1vibV6LTuthcT2aFPVlas1roFJIEB4WJBjIATdstiX7EsVDFCXCSRZPPDewOhZfKP2qznYQ3pj1H6TnF5zaePUWv7SOKq1DuSaqda6gY02RMraL3Jjs6DvxzbEUbxMp4K4clBb7LWQtLi5w1tuYJg0d83QZHTIkcK1RdvfDsqg135TGcWuxY06F1Xc0w6X2GEENG2q3Ys5ajKStzVQ5KCWRxsiltMSFhod3OouPjdvBEId5WZLVev2Rp3Hotad3RBrkLROdilHgx5bebTIedQ59nsC83bqPDX3jjriYZ+Vct7QeksOjRjLgxvWBWtHPeC5hwQWZYG0Jmvo/ZpAHijZyXVPCQdIawNTD6xdyY4B8RD2JFaP1Vhva8c8XUkCSwZCENOqDDC18qzHSsDOqrwESCZlUYnmDx8sqp22nQJEIYm4poJBHcmY79k2MfPVQtqICtZrD6xnK1IfJLPgdbOjjMUwd6w22iQApTSS6rHk5J/OpyhSk5CAxUmeCrkPVH35gNVaI+YiA/s+NXlzWRgppxKy+n+sJJWvgvLHz5L6qHOcrfKV0OKXDe0i5yrSSzaZri/osj5yvjqpL+jytdGp4A/mf00gq5NZE2AHsoa9LZ7dFdmC1TUxd0XWsLfFs7siW7C6JuauyBr2tnj2xijyGZrT8TNGmdBrAAAAAElFTkSuQmCC">
      </td>

      <td class="menu-table-cell">
        <!-- Add icon by Icons8 -->
        <img class="icon icons8-Add centered" width="50" height="50" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAADcElEQVRoQ+2agZHUMAxF/1XAdQBUAFQAVABUAFRwUAFQAXQAVABUAFQAVHBHB1ABzJuxGCexEzlRsrsZNLOzu7OOrS99S7K8Z9qJnO0Eh/4DqXjygaTbku5JOk+f86HfJf2S9EUSnz9FMSLCIyj9WNKTmUq9k/Q+gZs5hRZR66Gk15JuZKt/zax9layeK4e3GM87z9/KfmT8c0kf56CZ4xEUeZvow5o/Jb1JCqBMizAXgJ5Jup4ehHZPJTXN1QoE+uAF+P87KQA1IoS5Mci1tI8A4/ZOCxAAYDkETvOZjRspGAjDEDSQl5JeeRbwAoFKtpmxVJQXajqyFmsirMWao+IBgrsvEpXgMxzeQlgLEFANr+CdqkwByS1zf0MQpjBgPqQvj8b2zBgQIsq3tLG3oNMUzdiPd2rRbAzI5xRi2dhzk10UBaEYSRdaw4yB1ICYSwmxeCY6OrUCJJqRV9gvRYrVgFwmAIekVB+s7VdqNCjWkRIQaidoRcbOy49WK64xHq9QAQwCTwmI8ZG6h9B7TEISJjEP9m0JyJ+k+c3WeqeCmMiHDOgww0IwBNojHd37QGyTU8VCsQgxw0zlLO9a7BGq5g69+pOTPV94Mql3VUnRQIo69oEQp+/WQlyD8vnQaCBF1vSBwGcOPfAZF0ZINBD0Q89OGO4DiV4UQ2wyZyQQ82aLF4vJzTHBwDiRQCyaOPT4N+RHodPieX5VIDUFDkIts+opbPaON3cbfk8hIdrRu3P8PcUSxaLjaImSx/2ootESK4lsqbiLRhbaTRlvBysOMXjlmMROrq6DFYrbSewYj7rFJDrVfKDpgFeOofmAN2hCNDUf8IqV9K6W5cr8o0lH+V498E016Ig4tGAOSTHrntCaIvIVrxumjp/uluVKHnGvPwUE/SyTsk+a7iwWggMEHXn2xeImtuliuYXvW9Asb567WrYejxgYq8MsadL3io5mWB8v4A1k0hOmXAsQnsnvLABBwwyLRQhNamhs13p4ZZWrN1OWegeq0W2x5IkC3Jk3XWCmlizXbBjE2rOEWEA0zdXqkdzyeAcAdhvLb4RrrMg7veN+J4bwyXi7ns4LSTI29HV7IVdmCRCbh9oMC0KNOQI18fCiK70IILnygLIXXM//EMA4rG5/4UDxRcpHe2SOF8KfifZIuILeCXcD5C8mC9AzPucDHQAAAABJRU5ErkJggg==">
      </td>
    </tr>

    <tr>
      <td class="menu-table-cell">
        <a id="reportLabel" href="#">Generate Reports</a>
      </td>

      <td class="menu-table-cell">
        <a id="infoLabel" href="#">View Information</a>
      </td>

      <td class="menu-table-cell">
        <a id="actionLabel" href="#">Perform Actions</a>
      </td>
    </tr>
    </table>

  </div> <!--col-->

  </div> <!--row-->


  <!-- REPORTS -->

  <div class="row subMenu" id="theMenu" style="background-color: orange;">

    <div class="col-md-4"><a href="#">Order Report</a></div>
    <div class="col-md-4"><a href="#">Payment Report</a></div>
    <div class="col-md-4"><a href="#">Expenditure Report</a></div>
    <div class="col-md-4"><a href="#">Outstanding Balance Report</a></div>
    <div class="col-md-4"><a href="#">Profit/Loss Report</a></div>

  </div>

  <!-- VIEW INFO -->

  <div class="row subMenu" id="theMenu2" style="background-color: red;">

    <div class="col-md-4"><a href="/customers">Customer</a></div>
    <div class="col-md-4"><a href="/tyres">Tyre</a></div>
    <div class="col-md-4"><a href="/consignments">Consignments</a></div>
    <div class="col-md-4"><a href="/lcs">LCs</a></div>
    <div class="col-md-4"><a href="/consignment_expenses">Expenses</a></div>
    <div class="col-md-4"><a href="/orders">Order</a></div>
    <div class="col-md-4"><a href="/payments">Payment</a></div>
    <div class="col-md-4"><a href="/stock">Stock</a></div>

    <div class="col-md-4"><a href="/consignment_containers">consignment_containers</a></div>

  </div>

  <!-- ACTIONS -->

  <div class="row subMenu" id="theMenu3" style="background-color: green;">

    <div class="col-md-4"><a href="/tyres/create">Add a new Tyre</a></div>
    <div class="col-md-4"><a href="/lcs/create">Add new LC</a></div>
    <div class="col-md-4"><a href="/performa_invoices/create">Add new Performa Invoice</a></div>
    <div class="col-md-4"><a href="/consignments/create">Add new consignments</a></div>
    <div class="col-md-4"><a href="/consignment_expenses/create">Add new expense</a></div>

    <div class="col-md-4"><a href="/customers/create">Add a Customer</a></div>
    <div class="col-md-4"><a href="/orders/create">Create new Order</a></div>
    <div class="col-md-4"><a href="/payments/create">Create new Payment Invoice</a></div>

    <div class="col-md-4"><a href="/consignment_containers/create">Add containers to Consignment</a></div>
    <div class="col-md-4"><a href="/container_contents/create">New Commercial Invoice</a></div>
    <div class="col-md-4"><a href="/hscodes/create">Create a new Hscode</a></div>

  </div>

</div> <!--container fluid-->
</div>

<div class="mainContent" style="width: 100%; height: auto;">

  @yield('content')

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
