@extends('layout.mainlayout')


@section('content')

<table>
  <tr>
    <td>LC#</td>
    <td>{{$lc->lc_num}}</td>
  </tr>
  <tr>
    <td>Date Issued</td>
    <td>{{$lc->date_issued}}</td>
  </tr>
  <tr>
    <td>Date Expiry</td>
    <td>{{$lc->date_expiry}}</td>
  </tr>
  <tr>
    <td>Invoice#</td>
    <td>{{$lc->foreign_amount}}</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Value(Foreign)</td>
    <td>{{$lc->foreign_amount}}</td>
  </tr>
  <tr>
    <td>Currency code</td>
    <td>{{$lc->currency_code}}</td>
  </tr>
  <tr>
    <td>Exchange rate</td>
    <td>{{$lc->exchange_rate}}</td>
  </tr>
  <tr>
    <td>Value(TK)</td>
    <td>{{$lc->foreign_amount * $lc->exchange_rate}}</td>
  </tr>
  <tr>
    <td>Expenses Paid(Foreign)</td>
    <td>{{$lc->foreign_expense}}</td>
  </tr>
  <tr>
    <td>Expenses Paid(Local)</td>
    <td>{{$lc->domestic_expense}}</td>
  </tr>
  <tr>
    <td>Expenses Total(TK)</td>
    <td>{{($lc->foreign_expense * $lc->exchange_rate)+$lc->domestic_expense}}</td>
  </tr>
  <tr>
    <td>Applicant</td>
    <td>{{$lc->applicant}}</td>
  </tr>
  <tr>
    <td>Beneficiary</td>
    <td>{{$lc->beneficiary}}</td>
  </tr>
  <tr>
    <td>Departing port</td>
    <td>{{$lc->port_depart}}</td>
  </tr>
  <tr>
    <td>Destination port</td>
    <td>{{$lc->port_arrive}}</td>
  </tr>
  <tr>
    <td>created_at</td>
    <td>{{$lc->created_at}}</td>
  </tr>
  <tr>
    <td>updated_at</td>
    <td>{{$lc->updated_at}}</td>
  </tr>
</table>


@endsection
