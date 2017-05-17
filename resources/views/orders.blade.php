@extends('layout')


@section('scripts')
  <style>
    .leftDiv{
      width : 50%;
      float : left;
      margin : auto;
    }
    .rightDiv{
      width : 50%;
      float : right;
      margin : auto;
    }

  </style>
@endsection

@section('content')

<div class="leftDiv">

<table class="DBinfo">
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

    </tr>
  @endforeach



</table>
</div>

<div class="rightDiv">
    <table class="DBinfo">
      <tr>
        <th> Tyre ID </th>
        <th> #remaining </th>
      </tr>
      @foreach ($in_stock as $item)
        <tr>

          <td>{{$item->tyre_id}}</td>
          <td>{{$item->in_stock}}</td>

        </tr>
      @endforeach

    </table>
</div>

@endsection
