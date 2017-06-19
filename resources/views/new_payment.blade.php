@extends('layout.mainlayout')


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
