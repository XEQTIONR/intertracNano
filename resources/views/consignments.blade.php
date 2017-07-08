@extends('layout.mainlayout')

@section('scripts')


@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Consignments <small>List of consignments imported.</small></h1>
      </div>
    </div>
  </div>

<table class="table table-hover">
<thead>
  <tr>
    <th>BOL#</th>
    <th>Exchange Rate</th>
    <th>Value(Foreign)</th>
    <th>Value(Local)</th>
    <th>Tax</th>
    <th>Land Date</th>
    <th>LC#</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>

<tbody>
  @foreach ($consignments as $consignment)
  <tr style="cursor: pointer;" onclick="location.href='/consignments/{{$consignment->BOL}}'">
    <td>{{$consignment->BOL}}</td>
    <td>{{$consignment->exchange_rate}}</td>
    <td>{{$consignment->value}}</td>
    <td>{{$consignment->value * $consignment->exchange_rate}}</td>
    <td>{{$consignment->tax}}</td>
    <td>{{$consignment->land_date}}</td>
    <td>{{$consignment->lc}}</td>
    <td>{{$consignment->created_at}}</td>
    <td>{{$consignment->updated_at}}</td>
    <!--<td><a href="/consignments/{{$consignment->BOL}}" >View Info</a></td>-->
  </tr>
  @endforeach
</tbody>


</table>
</div>
@endsection
