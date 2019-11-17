<table id="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th class="text-center">Transaction ID</th>
    <th class="text-center">Order #</th>
    <th class="text-center">Amount Paid (&#2547)</th>
    <th class="text-center">Created</th>
  </tr>
</thead>
<tbody>
  @foreach ($payments as $payment)
    <tr>
      <td class="text-center strong">{{ str_pad($payment->transaction_id, 10, "0", STR_PAD_LEFT) }}</td>
      <td class="text-center">{{$payment->Order_num}}</td>
      <td class="text-right">{{$payment->payment_amount}}</td>
      <td class="text-center">{{$payment->created_at}}</td>
    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($payments, 'links'))
  {{$payments->links()}}
@endif
