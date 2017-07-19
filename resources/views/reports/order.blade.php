@extends('layout.mainlayout')

@section('scripts')
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
  <script src="/js/dough.js" type="text/javascript"></script>
  <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>






  <style>
  path.color0 {
      fill: teal;  /*filled section color*/
  }
  path.color1 {
      fill: #AAA; /*unfilled section color*/
  }
  text {
      font-size: 2em;
      font-weight: 400;
      line-height: 16em;
      fill: teal;
  }
  </style>
@endsection

@section('content')

<div class="container">
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="page-header">
      <h1>Order Reports</h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
  <form class="form-inline">
  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
    <label for="month">Monthly Report For</label>
    <input type="text" class="form-control" id="month" placeholder="Report for Month">
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label for="year">or Yearly Report For</label>
    <input type="text" class="form-control" id="year" placeholder="Report for Year">
  </div>
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
    <label for="quarter"> or Quarterly Report For</label>
    <input type="number" class="form-control" id="quarter" min="1" max=4 placeholder="1-4">
  </div>
  <div class="form-group">
    <label for="qyear">of Year</label>
    <input type="text" class="form-control" id="qyear" placeholder="Report for Year">
  </div>
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">
    <button>Generate Report</button>
  </div>
  </div>
  </form>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="white-card">
      <h1 class="stat">ORDER REPORT FOR {{$time_frame}} OF {{$year}}</h1>
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
      </div>
    </div> <!--white-card-->
  </div> <!--col-md-12-->
</div> <!--first-row-->

<div class="row">
  <div class="col-md-6">
    <div class="white-card">
      <div class="row">
        <div id="myDiv2" class="col-md-2 stat-diagram">
          <script>
            @if ($count>0)
              build({{$orders_with_payments*100.0/$count}}, 100, ".1%","#myDiv2");
            @else
              build(0, 100, ".1%","#myDiv2");
            @endif
          </script>
        </div>
        <div class="col-md-4 col-md-offset-4">
          <div class="row marg-top">
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
    </div><!--white-card-->
  </div>

  <div class="col-md-6">
    <div class="white-card">
      <div class="row">
        <div id="myDiv" class="col-md-2 stat-diagram" {{--style="border: 2px solid red;"--}}>

          <script>
            @if ($count>0)
              build({{$orders_full_paid*100.0/$count}}, 100, ".1%","#myDiv");
            @else
              build(0, 100, ".1%","#myDiv");
            @endif
          </script>
        </div>
        <div class="col-md-4 col-md-offset-4 ">
          <div class="row marg-top">
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


      </div> <!--row-->
    </div> <!--white-card-->
  </div>
</div><!--row-->

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
                AVERAGE NUMBER OF TYRES IN EACH ORDER
            </div>
          </div>
        </div>
      </div>
</div> <!-- second  row-->



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
