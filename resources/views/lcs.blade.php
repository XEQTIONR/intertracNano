@extends('layouts.app')

@section('title')
  Letters of credit
@endsection
@section('subtitle')
  All LCs applied for.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Letters of Credit',
    'subcrumb' => 'All LCs',
     'link' => route('lcs.index')])
  @endcomponent
@endsection


{{--<div class="container"> <!-- bootsreap container -->--}}

  {{--<div class="row">--}}
    {{--<div class="col-md-10 col-md-offset-1">--}}
      {{--<div class="page-header">--}}
        {{--<h1>LCs <small>All LCs applied for.</small></h1>--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
@section('body')
  <div class="box">
    <div class="box-body">
      <table id ="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th>LC#</th>
          <th>Date Issued</th>
          <th>Date Expiry</th>
          {{--<th>Invoice#</th>--}}
          <th>Exchange Rate</th>
          <th>Expenses Total(&#2547)</th>
          <th>LC Value($)</th>
          <th>LC Value(&#2547)</th>

        </tr>
        </thead>

        <tbody>
        @foreach ($LCs as $LC)
          <tr style="cursor: pointer;" onclick="location.href='/lcs/{{$LC->lc_num}}'">
            <td class="text-center">{{$LC->lc_num}}</td>
            <td class="text-center">{{$LC->date_issued}}</td>
            <td class="text-center">{{$LC->date_expiry}}</td>
            {{--<td class="text-center">{{$LC->invoice_no}}</td>--}}
            <td class="text-right">{{$LC->exchange_rate}}</td>
            <td class="text-right">{{($LC->foreign_expense * $LC->exchange_rate)+$LC->domestic_expense}}</td>
            <td class="text-right">{{$LC->foreign_amount}}</td>
            <td class="text-right">{{$LC->foreign_amount * $LC->exchange_rate}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>


@endsection
