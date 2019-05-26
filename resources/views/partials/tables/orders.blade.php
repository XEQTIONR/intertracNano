<table id="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th class="col-xs-1">Order#</th>
    <th class="col-xs-2">Customer ID</th>
    <th class="col-xs-1">Discount%</th>
    <th class="col-xs-2">Discount Amount(&#2547)</th>
    <th class="col-xs-1">Tax%</th>
    <th class="col-xs-2">Tax Amount(&#2547)</th>
    <th class="col-xs-1">Total(&#2547)</th>
    <th class="col-xs-2">Created</th>
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
      <td class="text-right">{{number_format($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount, 2) }}</td>
      <td class="text-center">{{$order->created_at}}</td>
    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($orders, 'links'))
  {{$orders->links()}}
@endif
