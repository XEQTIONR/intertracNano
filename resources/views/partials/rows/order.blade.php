<div class="row">
  <div class="col-xs-12 col-md-4 invoice-col mx-3">
    <small class="text-uppercase">Order By</small><br>
    <address>
      <b>{{$order->customer->name}}</b>
    </address>
  </div>
</div>
@if(count($order->payments) == 0)
<div class="row">
  <div class="col-xs-12 col-md-4 my-2 invoice-col mx-3">
    <button class="btn btn-xs btn-warning" onclick="location.href='orders/{{$order->Order_num}}/edit'"><b>EDIT</b></button>
  </div>
</div>
@endif
<div class="row">
  <div class="col-xs-12 col-md-4 my-2 invoice-col mx-3">
    <small class="text-uppercase"><b>Order/Invoice</b></small><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 mx-2">
    <table class="table table-striped table-bordered">
      <thead>
      <tr>
        <th class="col-xs-1">#</th>
        <th class="col-xs-5">Tyre</th>
        <th class="col-xs-2">Qty</th>
        <th class="col-xs-2">Unit Price</th>
        <th class="col-xs-2 text-right">Subtotal</th>
      </tr>
      </thead>
      <tbody>
      <?php $i= 0 ?>
      @foreach($order->orderContents as $item)
      <?php $i++ ?>
      <tr>
        <td class="col-xs-1">{{$i}}</td>
        <td class="col-xs-5"><b>({{ $item->tyre->tyre_id }})</b> {{ $item->tyre->brand }} {{ $item->tyre->size }} {{ $item->tyre->pattern }} {{ $item->tyre->lisi }}</td>
        <td class="col-xs-2">{{ $item->qty }}</td>
        <td class="col-xs-2">৳ {{ $item->unit_price }}</td>
        {{--<td class="col-xs-2"> @{{ parseFloat(item.unit_price)* parseInt(item.qty) / parseFloat(subTotal) |percentage_rounded}}</td>--}}
        <td class="col-xs-2 text-right">৳ {{ number_format(floatval($item->unit_price)* intval($item->qty), 2)}}</td>
      </tr>
      @endforeach
      <tr>
        <td></td>
        <td><b>Total</b></td>
        <td><b>{{$order->qtytotal}}</b></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->subtotal, 2)}}</b></td>
      </tr>
      @if($order->discounttotal>0)
      <tr>
        <td></td>
        <td><b>Discount @if($order->discount_percent>0)<span class="ml-2">({{$order->discount_percent}} %)</span>@endif</b></td>
        <td>
          @if($order->discount_amount>0)
          <span class="ml-2">
            <b>
              <i class="fa fa-minus mr-2"></i>
              ৳ {{$order->discount_amount}}
            </b>
          </span>
          @endif
        </td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->discounttotal, 2)}}</b></td>
      </tr>
      @endif
      @if($order->taxtotal>0)
      <tr>
        <td></td>
        <td><b>Tax @if($order->tax_percentage>0)<span class="ml-2">({{$order->tax_percentage}} %)</span>@endif</b></td>
        <td>
          @if($order->tax_amount>0)
          <span class="ml-2">
            <b>
              <i class="fa fa-plus mr-2"></i>
              ৳ {{$order->tax_amount}}
            </b>
          </span>
          @endif
        </td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->taxtotal, 2)}}</b></td>
      </tr>
      @endif
      <tr>
        <td></td>
        <td class="text-uppercase"><b>Grand Total</b></td>
        <td></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->grandtotal, 2)}}</b></td>
      </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-4 my-2 invoice-col mx-3">
    <small class="text-uppercase"><b>Payments</b></small><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 mx-2">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th class="col-xs-1">Transaction Id</th>
        <th class="col-xs-3 text-center">Payment Date</th>
        <th class="col-xs-2 text-right">Amount Paid</th>
        <th class="col-xs-2 text-right">Refund Amount</th>
        <th class="col-xs-2"></th>
        <th class="col-xs-2 text-right">Balance</th>
      </tr>
      </thead>
      <tbody>
      @foreach($order->payments->sortByDesc('created_at') as $payment)
        <?php
          $class = "";
          if($payment->refund_amount>0)
            $class = " danger ".$class;
          if($payment->refund_amount == $payment->payment_amount)
            $class = " strikethrough-red ".$class;
        ?>
      <tr @if($payment->refund_amount>0) class="{{$class}}"   @endif>
        <td class="col-xs-1"> {{ str_pad($payment->transaction_id, 10, "0", STR_PAD_LEFT) }}</td>
        <td class="col-xs-3 text-center"> {{ $payment->created_at  }}</td>
        <td class="col-xs-2 text-right">৳ {{ number_format($payment->payment_amount, 2) }}</td>
        <td class="col-xs-2 text-right">৳ {{ number_format($payment->refund_amount, 2) }}</td>
        <td class="col-xs-2"></td>
        <td class="col-xs-2 text-right"><b>৳ {{ number_format($payment->balance, 2) }}</b></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@if($order->grandtotalReturn>0)
<div class="row">
  <div class="col-xs-12 col-md-4 my-2 invoice-col mx-3">
    <small class="text-uppercase"><b>Returns</b></small><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 mx-2">
    <table class="table table-striped table-bordered">
      <thead>
      <tr>
        <th class="col-xs-1">#</th>
        <th class="col-xs-3">Tyre</th>
        <th class="col-xs-2">Return Date</th>
        <th class="col-xs-2">Qty</th>
        <th class="col-xs-2">Unit Price</th>
        <th class="col-xs-2 text-right">Subtotal</th>
      </tr>
      </thead>
      <tbody>
      <?php $i= 0 ?>
      @foreach($order->orderReturns as $item)
        <?php $i++ ?>
        <tr>
          <td class="col-xs-1">{{ $i }}</td>
          <td class="col-xs-3"><b>({{ $item->tyre->tyre_id }})</b> {{ $item->tyre->brand }} {{ $item->tyre->size }} {{ $item->tyre->pattern }} {{ $item->tyre->lisi }}</td>
          <td class="col-xs-2">{{ $item->created_at }}</td>
          <td class="col-xs-2">{{ $item->qty }}</td>
          <td class="col-xs-2">৳ {{ $item->unit_price }}</td>
          {{--<td class="col-xs-2"> @{{ parseFloat(item.unit_price)* parseInt(item.qty) / parseFloat(subTotal) |percentage_rounded}}</td>--}}
          <td class="col-xs-2 text-right">৳ {{ number_format(floatval($item->unit_price)* intval($item->qty), 2)}}</td>
        </tr>
      @endforeach
      <tr>
        <td></td>
        <td><b>Total</b></td>
        <td></td>
        <td><b>{{$order->qtytotalReturn}}</b></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->subtotalReturn, 2)}}</b></td>
      </tr>
      @if($order->discounttotalReturn>0)
      <tr>
        <td></td>
        <td><b>Discount @if($order->discount_percent>0)<span class="ml-2">({{$order->discount_percent}} %)</span>@endif</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->discounttotalReturn, 2)}}</b></td>
      </tr>
      @endif
      @if($order->taxtotalReturn>0)
      <tr>
        <td></td>
        <td><b>Tax  @if($order->tax_percentage>0)<span class="ml-2">({{$order->tax_percentage}} %)</span>@endif</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->taxtotalReturn, 2)}}</b></td>
      </tr>
      @endif
      <tr>
        <td></td>
        <td class="text-uppercase"><b>Grand Total</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><b>৳ {{number_format($order->grandtotalReturn, 2)}}</b></td>
      </tr>
      </tbody>
    </table>
  </div>
</div>
@endif


