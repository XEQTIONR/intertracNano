@extends('layout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>LC#</th>
    <th>Date Issued</th>
    <th>Date Expiry</th>
    <th>Applicant</th>
    <th>Beneficiary</th>
    <th>Port Depart</th>
    <th>Port Arrive</th>
    <th>Invoice#</th>
    <th>Currency Code</th>
    <th>Exchange Rate</th>
    <th>LC Value(Foreign)</th>
    <th>LC Value(Domestic)</th>
    <th>Expenses Paid (Foreign)</th>
    <th>Expenses Paid (Local)</th>
    <th>Expenses Total(Local)</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($LCs as $LC)
    <tr>
      <td>{{$LC->lc_num}}</td>
      <td>{{$LC->date_issued}}</td>
      <td>{{$LC->date_expiry}}</td>
      <td>{{$LC->applicant}}</td>
      <td>{{$LC->beneficiary}}</td>
      <td>{{$LC->port_depart}}</td>
      <td>{{$LC->port_arrive}}</td>
      <td>{{$LC->invoice_no}}</td>
      <td>{{$LC->currency_code}}</td>
      <td>{{$LC->exchange_rate}}</td>
      <td>{{$LC->foreign_amount}}</td>
      <td>{{$LC->foreign_amount * $LC->exchange_rate}}</td>
      <td>{{$LC->foreign_expense}}</td>
      <td>{{$LC->domestic_expense}}</td>
      <td>{{($LC->foreign_expense * $LC->exchange_rate)+$LC->domestic_expense}}</td>
      <td>{{$LC->created_at}}</td>
      <td>{{$LC->updated_at}}</td>
    </tr>
  @endforeach



</table>

@endsection
