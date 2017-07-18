@extends('layout.mainlayout')

@section('scripts')
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
  <script src="/js/dough.js" type="text/javascript"></script>
  <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

  <style>
  path.color0 {
      fill: red;  /*filled section color*/
  }
  path.color1 {
      fill: #AAA; /*unfilled section color*/
  }
  text {
      font-size: 1em;
      font-weight: 400;
      line-height: 16em;
      fill: red;
  }
  </style>
@endsection

@section('content')

<div class="container-fluid">
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="page-header">
      <h1>Order Reports</h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="white-card">

      <div class="row">

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
              {{$count}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
              ORDERS PLACED
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
              {{$count_tyres}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
              TYRES SOLD
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
              {{$total_value}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
              TOTAL VALUE OF ORDERS
            </div>
          </div>
        </div>
      </div> <!--first-row-->
    </div> <!--white-card-->
  </div> <!--col-md-12-->
</div>

<div class="row">
      <div class="col-md-6">
        <div class="white-card">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
                 {{$avg_value}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
                AVERAGE VALUE PER ORDER
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="white-card">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
                 {{$avg_tyre}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
                AVERAGE VALUE PER TYRE
            </div>
          </div>
        </div>
      </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="white-card">
      <div class="row">
        <div class="col-md-12 stat stat-figure">
          {{$orders_with_payments}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 stat stat-text">
          ORDERS WITH PAYMENTS
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="white-card">
      <div class="row">

        <div id="myDiv" class="col-md-2 col-md-offset-2 stat-diagram" style="border: 2px solid red;">

          <script>
            build({{$orders_full_paid*100.0/$count}}, 100, ".1%","#myDiv");
          //build();
          </script>

        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12 stat stat-figure">
              {{$orders_full_paid}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stat stat-text">
              ORDERS PAID IN FULL
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div><!--row-->

<div class="row">
  <div class="col-md-4">
    <div class="white-card">
      HEY
    </div>
  </div>
  <div class="col-md-4">
    <div class="white-card">
      HEY
    </div>
  </div>
  <div class="col-md-4">
    <div class="white-card">
      HEY
    </div>
  </div>
</div>
</div><!--container-->

  {{--  <div class="row">
      <div class="col-md-6 white-card">

        Report generated on:{{$date}}<br>
        Report for {{$time_frame}} year {{$year}}<br>
        1.No of order: {{$count}}<br>
        2.Total tyres sold: {{$count_tyres}}<br>
        3.Total Value: {{$total_value}}<br>
        4.Avg no of tyres in each order: {{$avg_tyre}}<br>
        5.Avg Value per order: {{$avg_value}}<br>
        6.No of order with payment: {{$orders_with_payments}}<br>
        7.Orders fully paid: {{$orders_full_paid}}

      </div>

      <div class="col-md-6">
        <div class="white-card">
        Report generated on:{{$date}}<br>
        Report for {{$time_frame}} year {{$year}}<br>
        1.No of order: {{$count}}<br>
        2.Total tyres sold: {{$count_tyres}}<br>
        3.Total Value: {{$total_value}}<br>
        4.Avg no of tyres in each order: {{$avg_tyre}}<br>
        5.Avg Value per order: {{$avg_value}}<br>
        6.No of order with payment: {{$orders_with_payments}}<br>
        7.Orders fully paid: {{$orders_full_paid}}
        </div>
      </div>

  </div>  --}}
@endsection
