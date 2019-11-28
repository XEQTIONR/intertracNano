<table id="table_id" class="table table-condensed table-bordered table-hover">
<thead>
  <tr>
    <th class="">Order #</th>
    <th class="">Customer ID</th>
    <th> Customer Name</th>
{{--    <th class="">Discount <br> %</th>--}}
{{--    <th class="">Discount <br> Amount(&#2547)</th>--}}
{{--    <th class="">Tax <br>%</th>--}}
{{--    <th class="">Tax <br> Amout(&#2547)</th>--}}
    <th class="">Order Total (&#2547)</th>
    <th class="">Payments Total(&#2547)</th>
    <th class="">Balance (&#2547)</th>
    <th class="">Order On</th>
    <th class="">Status</th>
  </tr>
</thead>
<tbody>
  @foreach ($orders as $order)
    <?php $total = $order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount ?>
    <tr style="cursor: pointer;">
      <td class="text-center details-control strong">{{$order->Order_num}}</td>
      <td class="text-center">{{$order->customer_id}}</td>
      <td class="">{{$order->name}}</td>
{{--      <td class="text-right">{{$order->discount_percent}}</td>--}}
{{--      <td class="text-right">{{$order->discount_amount}}</td>--}}
{{--      <td class="text-right">{{$order->tax_percentage}}</td>--}}
{{--      <td class="text-right">{{$order->tax_amount}}</td>--}}
      <td class="text-right">{{number_format($total, 2) }}</td>
      <td class="text-right">{{number_format($order->payments_total,2)}}</td>
      <td class="text-right">{{number_format($total - $order->payments_total,2)}}</td>
      <td class="text-center">{{$order->order_on}}</td>
      <td class="">
        @if($order->payments_total == 0)
          <span class="label label-danger">No payments</span>
        @elseif(($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount) == $order->payments_total)
          <span class="label label-success">Paid Off</span>
        @else
          <?php $percentage = intval(($order->payments_total*100)/($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount)); ?>
{{--          <span class="label label-warning">{{intval(($order->payments_total*100)/($order->total - ($order->total* $order->discount_percent/100.0) - $order->discount_amount + ($order->total* $order->tax_percentage/100.0) + $order->tax_amount))}}%</span>--}}

          <div class="progress progress-xs" data-toggle="tooltip" title="{{$percentage}}% Paid">
            <div class="progress-bar progress-bar-<?php if($percentage<33) echo "danger"; else {  echo $percentage<66 ?  "warning" :  "success"; } ?>"
                 style="width: {{$percentage}}%"></div>
          </div>

        @endif
      </td>
    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($orders, 'links'))
  {{$orders->links()}}
@endif
