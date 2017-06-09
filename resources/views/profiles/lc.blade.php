@extends('layout.mainlayout')

@section('scripts')

<script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true,
      active: false
    });
  });
</script>
@endsection

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



<div id="accordion">
  <h3>Performa Invoice</h3>
  <div>
    <table>
      <tr>
        <th>Tyre ID</th>
        <th>Qty</th>
        <th>Unit Price</th>

        <th>created_at</th>
        <th>updated_at</th>
      </tr>


      @foreach ($performa as $record)
      <tr>
        <td>{{$record->tyre_id}}</td>
        <td>{{$record->qty}}</td>
        <td>{{$record->unit_price}}</td>

        <td>{{$record->created_at}}</td>
        <td>{{$record->updated_at}}</td>
      </tr>
      @endforeach

    </table>

  </div>
  <h3>Consignments</h3>
  <div>
    <table>
      <tr>
        <th>Bill Of Lading#</th>
        <th>Total Value</th>
        <th>Tax Paid</th>
        <th>Land Date</th>
        <th>created_at</th>
        <th>updated_at</th>
      </tr>


      @foreach($consignments as $consignment)
        <tr>
          <td>{{$consignment->BOL}}</td>
          <td>{{$consignment->value}}</td>
          <td>{{$consignment->tax}}</td>
          <td>{{$consignment->land_date}}</td>
          <td>{{$consignment->created_at}}</td>
          <td>{{$consignment->updated_at}}</td>
          <td><a href="/consignments/{{$consignment->BOL}}" >View Consignment</a></td>
        </tr>
      @endforeach

    </table>

  </div>
</div>


@endsection
