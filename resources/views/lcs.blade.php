@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootsreap container -->


<table class="table table-hover table-bordered">
  <tr>
    <th>LC#</th>
    <th>Date Issued</th>
    <th>Date Expiry</th>
    <th>Invoice#</th>
    <th>LC Value(Foreign)</th>
    <th>LC Value(Domestic)</th>
    <th>Expenses Total(Local)</th>
<!--    <th>Applicant</th>
    <th>Beneficiary</th>
    <th>Port Depart</th>
    <th>Port Arrive</th> -->

<!--    <th>Currency Code</th>
    <th>Exchange Rate</th>  -->

<!--    <th>Expenses Paid (Foreign)</th>
    <th>Expenses Paid (Local)</th> -->

<!--    <th>Created</th>
    <th>Updated</th> -->
  </tr>


  @foreach ($LCs as $LC)
    <tr>
      <td>{{$LC->lc_num}}</td>
      <td>{{$LC->date_issued}}</td>
      <td>{{$LC->date_expiry}}</td>
      <td>{{$LC->invoice_no}}</td>
      <td>{{$LC->foreign_amount}}</td>
      <td>{{$LC->foreign_amount * $LC->exchange_rate}}</td>
      <td>{{($LC->foreign_expense * $LC->exchange_rate)+$LC->domestic_expense}}</td>

      <td><a href="/lcs/{{$LC->lc_num}}" class="btn btn-primary"> VIEW INFO</a></td>

    </tr>
  @endforeach



</table>

</div>
@endsection
