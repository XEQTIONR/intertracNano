@extends('layout.mainlayout')

@section('scripts')

<script>
  $(document).ready(function(){
    $("#inputOrderNum").change(function(){
      //alert($("#inputOrderNum").val());
      var base = "/orders/json/";
      var number = $("#inputOrderNum").val();
      var url = base.concat(number);

      //alert(url);
      $.getJSON(url, function(data, status){
        $("#orderDetails").html("");

        if(data.order == null)
        {
          $("#orderDetails").html("<h4>NOT FOUND<small>Invalid Order</small></h4>");
        }
        else
        {

          $("#orderDetails").append(status);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.Order_num);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.customer_id);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.discount_percent);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.discount_amount);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.created_at);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.updated_at);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.tax_percentage);
          $("#orderDetails").append("<br>");

          $("#orderDetails").append(data.order.tax_amount);
          $("#orderDetails").append("<br>");

        }
        //alert(data.Order_num);
      });
    });
  });
</script>
@endsection


@section('content')


<div class="container">

<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="page-header">
      <h1>New Payment <small>Record a new payment made for an existing order.</small></h1>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-4 col-md-offset-2">
<form class="form-horizontal" method="post" action="/payments">

  {{ csrf_field() }}



  <div class="form-group">
    <label for="inputOrderNum" class="col-md-6 control-label">Order#</label>
    <div class="col-md-6">
      <input type="text" class="form-control" name="inputOrderNum" id="inputOrderNum">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPaidAmount" class="col-md-6 control-label">Amount Paid</label>
    <div class="col-md-6">
      <input type="text" class="form-control" name="inputPaidAmount" id="inputPaidAmount">
    </div>
  </div>

  <div class="col-md-2 col-md-push-6">
    <button type="submit" value="submit">Submit</button>
  </div>
</form>
</div>

<div class="col-md-4" id="orderDetails"</div>



</div><!--row-->
</div><!--container-->

@endsection
