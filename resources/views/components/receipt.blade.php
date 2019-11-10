@extends('layouts.app')

@section('title')
  Orders
@endsection
@section('subtitle')
  View Receipt.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Orders',
    'subcrumb' => 'View Receipt',
     'link' => route('orders.receipt', $order )])
  @endcomponent
@endsection

@section('body')
  <div class="row justify-content-center">
    <div class="col-xs-12 col-md-10">
      <section class="invoice">
        <div class="row">
          <div class="col-xs-12 ">
            <h2 class="page-header">
              <img src="/images/intertracnanologo.png" height="75" width="auto">
              <small class="pull-right">Date : {{\Carbon\Carbon::createFromFormat('Y-m-d', $order->order_on)->format('d/m/Y')}}</small>
            </h2>
            <h2 v-if="is_complete" class="text-center text-uppercase mb-4"><b>Invoice</b></h2>
          </div>
          <!-- /.col -->
        </div>

        <div class="row invoice-info">

          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <small class="text-uppercase">Bill To</small><br>
            <address v-if="customer">
              <b>{{ $order->customer->name }}</b> <br>
              <span> {!!  $order->customer->address  !!}</span> <br>
              {{$order->customer->phone}}
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <small class="text-uppercase">Beneficiary</small><br>
            <address>
              <b>Intertrac Nano</b> <br>
              7/5 Ring Road, <br>
              Shyamoli, <br>
              Dhaka - 1207 <br>
            </address>
          </div>

          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Order # </b>{{ $order->Order_num }}<br>
          </div>

        </div>

        <div class="row mt-4">
          <div class="col-xs-12 ">
            <table class="table table-striped table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th>Tyre</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Sub-total</th>
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
              <tr class="warning">
                <td></td>
                <td><b>Total</b></td>
                <td><b>{{$order->qtytotal}}</b></td>
                <td></td>
                <td class="text-right">৳ {{number_format($order->subtotal, 2)}}</td>
              </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-5">
            <div class="row">
              <p class="lead ml-5 ">Additional information</p>
            </div>
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              This receipt is a copy.
            </p>
          </div>

          <div class="col-xs-12 col-md-7">
            <div class="table-responsive mt-5 pt-3">
              <table class="table">
                <tbody>
                <tr>
                  <th style="width: 60%;" colspan="2">Total:</th>
                  <td class="text-right">৳ {{number_format($order->subtotal, 2)}}</td>
                  <td></td>
                </tr>
                <tr>
                  <th>Tax @if($order->tax_percentage>0)<span class="ml-2">({{$order->tax_percentage}} %)</span>@endif
                    @if($order->tax_amount>0)
                      <span class="ml-2">
                        <b>
                          <i class="fa fa-plus mr-2"></i> ৳ {{$order->tax_amount}}
                        </b>
                      </span>
                    @endif


                  </th>
                  <td><i class="fa fa-plus mr-2"></i></td>
                  <td class="text-right">৳ {{number_format($order->taxtotal,2) }}</td>
                  <td></td>
                </tr>
                <tr>
                  <th>Discount @if($order->discount_percent>0)<span class="ml-2">({{$order->discount_percent}} %)</span>@endif
                    @if($order->discount_amount>0)
                      <span class="ml-2">
                        <i class="fa fa-minus mr-2"></i> ৳ {{$order->discount_amount}}
                      </span>
                    @endif
                  </th>
                  <td><i class="fa fa-minus mr-2"></i></td>
                  <td class="text-right">৳ {{number_format($order->discounttotal, 2)}}</td>
                  <td></td>
                </tr>
                <tr>
                  <th colspan="2" style="border-top: 1px solid #bbb;">Grand Total:</th>
                  <td class="text-right" style="border-top: 1px solid #bbb;"><b>৳ {{number_format($order->grandtotal, 2)}}</b></td>
                  <td></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row no-print">
          <div class="col-xs-12">
            <button onclick="window.print()" class="btn btn-default">
              <i class="fa fa-print"></i> Print
            </button>
          </div>
        </div>
      </section>
    </div>
  </div>


@endsection