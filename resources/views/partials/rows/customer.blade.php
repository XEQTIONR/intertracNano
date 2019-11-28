<div class="row">
  <div class="col-xs-12 col-md-4 invoice-col mx-3">
    <address>
      <b>{{$customer->name}}</b>
      <br>
      {{$customer->address}}
    </address>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <small class="text-uppercase">Orders</small><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Order_num</th>
        <th>Discount %</th>
        <th class="text-right">Discount Amount</th>
        <th>Tax %</th>
        <th class="text-right">Tax Amount</th>
        <th class="text-right">Total</th>
        <th class="text-right">Payments Total</th>
        <th class="text-right">Balance <br></th>
      </tr>
      </thead>
      <tbody>
        <?php
          $total_total = 0;
          $payments_total = 0;
          $balance_total = 0;
        ?>
        @foreach($ret as $row)
        <tr>
          <td>{{$row->Order_num}}</td>
          <td>{{$row->discount_percent}}</td>
          <td class="text-right">{{$row->discount_amount}}</td>
          <td>{{$row->tax_percentage}}</td>
          <td class="text-right">{{$row->tax_amount}}</td>
          <td class="text-right">{{number_format($row->total,2)}}</td>
          <td class="text-right">{{number_format($row->payments_total,2)}}</td>
          <td class="text-right">{{number_format($row->total - $row->payments_total,2)}}</td>
        </tr>
        <?php
          $total_total+=$row->total;
          $payments_total+= $row->payments_total;
          $balance_total+= ($row->total - $row->payments_total);
        ?>
        @endforeach
        <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="strong text-right">{{number_format($total_total,2)}}</td>
          <td class="strong text-right">{{number_format($payments_total,2)}}</td>
          <td class="strong text-right">{{number_format($balance_total,2)}}</td>
        </tr>
        </tfoot>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-md-6">
    <small class="text-uppercase">Last 10 payments</small><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Order #</th>
          <th>Payment Amount</th>
          <th>Refund Amount</th>
          <th>Payment On</th>
        </tr>
      </thead>
      <tbody>
        @foreach($payments as $payment)
          <tr>
            <td>{{$payment->transaction_id}}</td>
            <td>{{$payment->Order_num}}</td>
            <td>{{$payment->payment_amount}}</td>
            <td>{{$payment->refund_amount}}</td>
            <td>{{date('d/m/Y',strtotime($payment->created_at))}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

