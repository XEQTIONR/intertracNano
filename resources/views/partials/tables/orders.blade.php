<table id="table_id" class="table table-condensed table-hover">
<thead>
  <tr>
    <th class="">Order#</th>
    <th class="">Customer ID</th>
    <th class="">Discount%</th>
    <th class="">Discount Amount(&#2547)</th>
    <th class="">Tax%</th>
    <th class="">Tax Amount(&#2547)</th>
    <th class="">Total(&#2547)</th>
    <th class="">Payments Total(&#2547)</th>
    <th class="">Created</th>
    <th class="">Status</th>
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
      <td class="text-right">{{$order->payments_total}}</td>
      <td class="text-center">{{$order->created_at}}</td>
      <td class="">
        @if($order->payments_total == 0)
          <span class="label label-danger">No payments</span>
        @elseif(($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount) == $order->payments_total)
          <span class="label label-success">Paid Off</span>
        @else
          <span class="label label-warning">{{intval(($order->payments_total*100)/($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount))}}%</span>
        @endif
      </td>
    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($orders, 'links'))
  {{$orders->links()}}
@endif
