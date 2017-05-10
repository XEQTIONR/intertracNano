@extends('layout')

@section('content')

<table class="DBinfo">
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
      <td>{{$payment->Order_num}}</td>
      <td>{{$payment->payment_amount}}</td>
      <td>{{$payment->created_at}}</td>
      <td>{{$payment->updated_at}}</td>

    </tr>
  @endforeach



</table>

@endsection
