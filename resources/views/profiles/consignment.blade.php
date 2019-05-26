@extends('layouts.app')


@section('body')

{{--<div class="container">--}}

  <div class="row">
    <div class="col-xs-12">
      <div class="page-header">
        <h1>Consignment information</h1>
      </div>
    </div>
  </div>

  <div class="row justify-content-center d-block">
    <div class="col-md-6">
      <div class="box box-teal">
        <div class="box-header with-border">
          <h3 class="box-title">Consignment</h3>
        </div>
        <div class="box-body">
          <dl class="dl-horizontal">

            <dt class="mb-2">Bill of Lading#</dt>
            <dd>{{$consignment->BOL}}</dd>

            <dt class="mb-2">LC#</dt>
            <dd><a href="/lcs/{{$consignment->lc}}">{{$consignment->lc}}</a></dd>

            <dt class="mb-2">Landed On</dt>
            <dd>{{$consignment->land_date}}</dd>

            <dt class="mb-2">Exchange_rate</dt>
            <dd>{{$consignment->exchange_rate}}</dd> {{--Change 60 to exchange_rate--}}

            <dt class="mb-2">Total Value (Foreign)</dt>
            <dd>{{$consignment->value}}</dd>

            <dt class="mb-2">Total Value (Local)</dt>
            <dd>{{$consignment->value * $consignment->exchange_rate}}</dd> {{--change 60 to excahnge rate--}}

            <dt class="mb-2">Total Tax Charged (TK)</dt>
            <dd>{{$consignment->tax}}</dd>
          </dl>
        </div>
      </div>
    </div> <!--col-->
    <div class="col-md-6 clearfix">
      <div class="box box-solid bg-purple">
        <div class="box-header bg-purple-active">
          <h3 class="box-title ">Containers</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color: white"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div>
            <?php $total = 0; $total_qty = 0; $total_tax = 0; $total_weight = 0 ?>
            @foreach ($containers as $container)
              <table class="table table-bordered inner-white">
                <thead>
                <tr>
                  <th colspan="6">Container# {{$container->Container_num}}</th>
                </tr>
                <tr>
                  <th class="col-xs-3">Tyre</th>
                  <th class="col-xs-1">Qty</th>
                  <th class="col-xs-2">Unit Price</th>
                  <th class="col-xs-2">Sub-total</th>
                  <th class="col-xs-2">Total Tax</th>
                  <th class="col-xs-2">Total Weight</th>
                </tr>

                </thead>
                <tbody>
                  @foreach ($contents as $content_one_container) {{--each container--}}
                  {{--@ means if not empty--}}
                  @if (@$content_one_container[0]->Container_num==$container->Container_num) {{-- if this container add BOL later --}}

                  @foreach($content_one_container as $listing) {{---each tyre qty price etc--}}
                  <tr>
                  <td class="col-xs-3">{{$listing->tyre->brand}} {{$listing->tyre->size}} {{$listing->tyre->pattern}} {{$listing->tyre->lisi}}</td>
                  <td class="col-xs-1">{{$listing->qty}}</td>
                  <td class="col-xs-2">{{number_format($listing->unit_price,2)}}</td>
                  <td class="col-xs-2">{{number_format($listing->qty * $listing->unit_price,2)}}</td>
                  <td class="col-xs-2">{{number_format($listing->total_tax,2)}}</td>
                  <td class="col-xs-2">{{number_format($listing->total_weight,2)}}</td>
                  </tr>
                    <?php
                      $total+= (floatval($listing->unit_price) * floatval($listing->qty));
                      $total_qty += intval($listing->qty);
                      $total_tax += floatval($listing->total_tax);
                      $total_weight += floatval($listing->total_weight);
                    ?>
                  @endforeach

                  @endif
                  @endforeach
                </tbody>
              </table>
            @endforeach
              <table class="table table-bordered inner-white bg-purple-active">
                <thead>
                  <tr>
                    <th class="col-xs-3 text-uppercase">Total</th>
                    <th class="col-xs-1">{{$total_qty}}</th>
                    <th class="col-xs-2"></th>
                    <th class="col-xs-2">{{ number_format($total, 2) }}</th>
                    <th class="col-xs-2">{{ number_format($total_tax, 2) }}</th>
                    <th class="col-xs-2">{{ number_format($total_weight, 2) }}</th>
                  </tr>
                </thead>
              </table>

            {{--<a href="/container_contents/create/{{$consignment->BOL}}" class="btn btn-primary">Add a container</a>--}}

          </div>
        </div>
      </div> <!--box-->
      <div class="box box-solid bg-maroon">
        <div class="box-header bg-maroon-active">
          <h3 class="box-title">Expenses</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color: white"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div>
            <table class="table table-responsive inner-white">
              <tr>
                <th>Expense ID</th>
                <th>Expense Note</th>
                <th>Expense Local</th>
                <th>Expense Foreign</th>
                <th class="text-right">Total</th>
              </tr>

            @foreach($expenses as $expense)
              <tr>
              <td>{{$expense->expense_id}}</td>
              <td>{{$expense->expense_notes}}</td>
              <td>৳ {{$expense->expense_local}}</td>
              <td>{{$expense->expense_foreign}}</td>
              <td class="text-right">৳ {{number_format($expense->expense_foreign*$consignment->exchange_rate+ $expense->expense_local,2)}}</td>
              </tr>
            @endforeach
              <tr class="strong">
                <td colspan="2" class="text-uppercase">Total</td>
                <td>৳ {{number_format($consignment->expense_local_total,2)}}</td>
                <td>{{number_format($consignment->expense_foreign_total,2)}}</td>
                <td class="text-right">৳ {{number_format($consignment->expense_grand_total,2)}}</td>
              </tr>
            </table>
            {{--<a href="/consignment_expenses/create/{{$consignment->BOL}}" class="btn btn-primary">Add an expense</a>--}}
          </div>
        </div>
      </div>
    </div>
  </div> <!--row-->

{{--</div> <!--container-->--}}

  {{-- view containers section--}}

@endsection
