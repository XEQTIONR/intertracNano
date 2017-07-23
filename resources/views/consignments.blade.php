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
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>BOL#</th>
            <th>Exchange Rate</th>
            <th>Value($)</th>
            <th>Value(&#2547)</th>
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
              <td class="text-center">{{$consignment->BOL}}</td>
              <td class="text-right">{{$consignment->exchange_rate}}</td>
              <td class="text-right">{{$consignment->value}}</td>
              <td class="text-right">{{$consignment->value * $consignment->exchange_rate}}</td>
              <td class="text-right">{{$consignment->tax}}</td>
              <td class="text-center">{{$consignment->land_date}}</td>
              <td class="text-center">{{$consignment->lc}}</td>
              <td class="text-center">{{$consignment->created_at}}</td>
              <td class="text-center">{{$consignment->updated_at}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
