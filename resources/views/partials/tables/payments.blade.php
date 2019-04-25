<table id="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th>Transaction ID</th>
    <th>Order #</th>
    <th>Amount Paid (&#2547)</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>
<tbody>
  @foreach ($payments as $payment)
    <tr>
      <td class="text-center">{{$payment->transaction_id}}</td>
      <td class="text-center"><a href="orders/{{$payment->Order_num}}">{{$payment->Order_num}}</a></td>
      <td class="text-right">{{$payment->payment_amount}}</td>
      <td class="text-center">{{$payment->created_at}}</td>
      <td class="text-center">{{$payment->updated_at}}</td>

    </tr>
  @endforeach
</tbody>
</table>

@if (method_exists($payments, 'links'))
  {{$payments->links()}}
@endif
