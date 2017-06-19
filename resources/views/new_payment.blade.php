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

        $("#orderDetails").append(status);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.Order_num);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.customer_id);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.discount_percent);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.discount_amount);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.created_at);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.updated_at);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.tax_percentage);
        $("#orderDetails").append("<br>");

        $("#orderDetails").append(data.tax_amount);
        $("#orderDetails").append("<br>");
        //alert(data.Order_num);
      });
    });
  });
</script>
@endsection


@section('content')


<div class="container">
<div class="row">
<div class="col-md-4">
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

<div class="col-md-8" id="orderDetails"> </div>



</div><!--row-->
</div><!--container-->

@endsection
