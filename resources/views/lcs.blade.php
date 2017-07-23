@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootsreap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>LCs <small>All LCs applied for.</small></h1>
      </div>
    </div>
  </div>

<table class="table table-hover table-condensed">
<thead>
  <tr>
    <th>LC#</th>
    <th>Date Issued</th>
    <th>Date Expiry</th>
    <th>Invoice#</th>
    <th>Exchange Rate</th>
    <th>LC Value($)</th>
    <th>LC Value(&#2547)</th>
    <th>Expenses Total(&#2547)</th>
  </tr>
</thead>

<tbody>
  @foreach ($LCs as $LC)
    <tr style="cursor: pointer;" onclick="location.href='/lcs/{{$LC->lc_num}}'">
      <td class="text-center">{{$LC->lc_num}}</td>
      <td class="text-center">{{$LC->date_issued}}</td>
      <td class="text-center">{{$LC->date_expiry}}</td>
      <td class="text-center">{{$LC->invoice_no}}</td>
      <td class="text-right">{{$LC->exchange_rate}}</td>
      <td class="text-right">{{$LC->foreign_amount}}</td>
      <td class="text-right">{{$LC->foreign_amount * $LC->exchange_rate}}</td>
      <td class="text-right">{{($LC->foreign_expense * $LC->exchange_rate)+$LC->domestic_expense}}</td>
    </tr>
  @endforeach
</tbody>
</table>

</div>
@endsection
