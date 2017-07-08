@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootstrap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Payments <small>List of payments made by customers</small></h1>
      </div>
    </div>
  </div>

<table class="table table-hover table-bordered">
  <tr>
    <th>Invoice#</th>
    <th>Order#</th>
    <th>Amount Paid</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($payments as $payment)
    <tr>
      <td>{{$payment->Invoice_num}}</td>
      <td><a href="orders/{{$payment->Order_num}}">{{$payment->Order_num}}</a></td>
      <td>{{$payment->payment_amount}}</td>
      <td>{{$payment->created_at}}</td>
      <td>{{$payment->updated_at}}</td>

    </tr>
  @endforeach



</table>

</div>
@endsection
