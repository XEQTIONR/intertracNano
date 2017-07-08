@extends('layout.mainlayout')





@section('content')

<div class="container"> <!-- bootsreap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Orders <small>All orders placed by customers.</small></h1>
      </div>
    </div>
  </div>


<table class="table table-hover table-bordered">
  <tr>
    <th>Order#</th>
    <th>Customer ID</th>
    <th>Discount%</th>
    <th>Discount Amount</th>
    <th>Tax Percentage</th>
    <th>Tax Amount</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($orders as $order)
    <tr>
      <td>{{$order->Order_num}}</td>
      <td>{{$order->customer_id}}</td>
      <td>{{$order->discount_percent}}</td>
      <td>{{$order->discount_amount}}</td>
      <td>{{$order->tax_percentage}}</td>
      <td>{{$order->tax_amount}}</td>
      <td>{{$order->created_at}}</td>
      <td>{{$order->updated_at}}</td>

      <td><a class="btn btn-primary" href = "/orders/{{$order->Order_num}}" >View Contents</a></td>

    </tr>
  @endforeach



</table>

<div>

@endsection
