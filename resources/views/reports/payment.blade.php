@extends('layout.mainlayout')

@section('scripts')
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
  <script src="/js/dough.js" type="text/javascript"></script>
  <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

  <script src="/js/reports.js" type="text/javascript"></script>




<style>

  .ui-datepicker-calendar{
    display: none;
  }
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
        <h1>Payment Reports</h1>
      </div>
    </div>
  </div>

  <div class="row">
    @include('partials.timeperiodselect')
  </div>

  <div class="row" style="margin-top: 1em;">
  <div class="col-md-12">
    <button class="btn btn-default" onclick="generateMonthlyReport('payment');">Generate Monthly Report</button>
    <button class="btn btn-default" onclick="generateQuarterlyReport('payment');">Generate Quarterly Report</button>
    <button class="btn btn-default" onclick="generateYearlyReport('payment')">Generate Yearly Report</button>
  </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-card">
        <h6>Report generated on {{$date}}</h6>
        <h1 class="stat">PAYMENT REPORT FOR {{$time_frame}} OF {{$report_year}}</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-card">
        <div class="row">
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 stat stat-figure">
                {{$num_payments}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 stat stat-text">
                PAYMENTS RECEIVED
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 stat stat-figure">
                {{$num_orders}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 stat stat-text">
                #ORDERS FOR WHICH A PAYMENT WAS RECEIVED
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 stat stat-figure">
                {{$total_value}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 stat stat-text">
                TOTAL VALUE OF PAYMENTS RECEIVED
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 stat stat-figure">
                {{$avg_payment}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 stat stat-text">
                AVG VALUE OF PAYMENTS RECEIVED
              </div>
            </div>
          </div>

        </div>
      </div> <!--white-card-->
    </div> <!--col-md-12-->
  </div> <!--first-row-->

  <div class="row">
    <table class="table table-condensed">
    <thead>
      <tr>
        <th>Invoice#</th>
        <th>Order#</th>
        <th>Amount Paid</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($payments as $payment)
        <tr>
          <td>{{$payment->Invoice_num}}</td>
          <td><a href="orders/{{$payment->Order_num}}">{{$payment->Order_num}}</a></td>
          <td>{{$payment->payment_amount}}</td>
          <td>{{$payment->created_at}}</td>
          <td>{{$payment->updated_at}}</td>

        </tr>
      @endforeach
    </tbody>
    </table>
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
