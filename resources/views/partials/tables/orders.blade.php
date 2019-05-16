<table id="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th>Order#</th>
    <th>Customer ID</th>
    <th>Discount %</th>
    <th>Discount Amount(&#2547)</th>
    <th>Tax %</th>
    <th>Tax Amount(&#2547)</th>
    <th>Created At</th>
    <th>Updated At</th>
  </tr>
</thead>
<tbody>
  @foreach ($orders as $order)
    <tr style="cursor: pointer;">
      <td class="text-center details-control strong">{{$order->Order_num}}</td>
      <td class="text-center">{{$order->customer_id}}</td>
      <td class="text-right">{{$order->discount_percent}}</td>
      <td class="text-right">{{$order->discount_amount}}</td>
      <td class="text-right">{{$order->tax_percentage}}</td>
      <td class="text-right">{{$order->tax_amount}}</td>
      <td class="text-center">{{$order->created_at}}</td>
      <td class="text-center">{{$order->updated_at}}</td>
    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($orders, 'links'))
  {{$orders->links()}}
@endif
