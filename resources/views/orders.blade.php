@extends('layout')

@section('scripts')
<script>

  function viewOrderItemsFor(order)
  {
    var base = '/orders/';
    var url = base + order; // '/container_contents/BOL'
    window.location.href = url;
  }

</script>
@endsection




@section('content')


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

      <td><button type="button"   onclick="viewOrderItemsFor('{{$order->Order_num}}')" >View Contents</button></td>

    </tr>
  @endforeach



</table>



@endsection
