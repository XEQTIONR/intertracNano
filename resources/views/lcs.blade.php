@extends('layout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>LC#</th>
    <th>Date Issued</th>
    <th>Date Expity</th>
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
  </tr>


  @foreach ($LCs as $LC)
    <tr>
      <td>{{$LC->id}}</td>
      <td>{{$LC->LC_dateissued}}</td>
      <td>{{$LC->LC_dateexpiry}}</td>
      <td>{{$LC->LC_applicant}}</td>
      <td>{{$LC->LC_beneficiary}}</td>
      <td>{{$LC->LC_portdepart}}</td>
      <td>{{$LC->LC_portarrive}}</td>
      <td>{{$LC->LC_invoice}}</td>
      <td>{{$LC->LC_currencycode}}</td>
      <td>{{$LC->LC_exchangerate}}</td>
      <td>{{$LC->LC_foreignamount}}</td>
      <td>{{$LC->LC_foreignamount * $LC->LC_exchangerate}}</td>
      <td>{{$LC->LC_foreignexpense}}</td>
      <td>{{$LC->LC_domesticexpense}}</td>
      <td>{{($LC->LC_foreignexpense * $LC->LC_exchangerate)+$LC->LC_domesticexpense}}</td>
    </tr>
  @endforeach



</table>

@endsection
