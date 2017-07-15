@extends('layout.mainlayout')

@section('scripts')

<script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true,
      active: false,
      heightStyle: "content"
    });
  });
</script>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>LC information</h1>
      </div>
    </div>
  </div>

<div class="row">
<div class="col-md-6 col-md-push-3">
  <dl class="dl-horizontal">
    <dt>LC#</dt>
    <dd>{{$lc->lc_num}}</dd>

    <dt>Date Issued</dt>
    <dd>{{$lc->date_issued}}</dd>

    <dt>Date Expiry</dt>
    <dd>{{$lc->date_expiry}}</dd>

    <dt>Invoice#</dt>
    <dd>{{$lc->invoice_no}}</dd>

    <dt></dt>
    <dd></dd>

    <dt>Value(Foreign)</dt>
    <dd>{{$lc->foreign_amount}}</dd>

    <dt>Currency code</dt>
    <dd>{{$lc->currency_code}}</dd>

    <dt>Exchange rate</dt>
    <dd>{{$lc->exchange_rate}}</dd>

    <dt>Value(TK)</dt>
    <dd>{{$lc->foreign_amount * $lc->exchange_rate}}</dd>

    <dt>Expenses Paid(Foreign)</dt>
    <dd>{{$lc->foreign_expense}}</dd>

    <dt>Expenses Paid(Local)</dt>
    <dd>{{$lc->domestic_expense}}</dd>

    <dt>Expenses Total(TK)</dt>
    <dd>{{($lc->foreign_expense * $lc->exchange_rate)+$lc->domestic_expense}}</dd>

    <dt>Applicant</dt>
    <dd>{{$lc->applicant}}</dd>

    <dt>Beneficiary</dt>
    <dd>{{$lc->beneficiary}}</dd>

    <dt>Departing port</dt>
    <dd>{{$lc->port_depart}}</dd>

    <dt>Destination port</dt>
    <dd>{{$lc->port_arrive}}</dd>

    <dt>Notes</dt>
    <dd>{{$lc->notes}}</dd>

    <dt>created_at</dt>
    <dd>{{$lc->created_at}}</dd>

    <dt>updated_at</dt>
    <dd>{{$lc->updated_at}}</dd>
  </dl>
</div> <!--col-->
</div> <!--row-->
</div> <!--container-->


<div id="accordion" class="container">

  <h3>Proforma Invoice</h3>
  <div>
    {{--SOMETHING RANDOM--}}
    <table class="table table-hover table-bordered">
      <tr>
        <th>Tyre ID</th>
        <th>Qty</th>
        <th>UnitPrice</th>
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
    <a href="#" class="btn btn-primary">Edit</a>
    <a href="#" class="btn btn-danger">Delete</a>

  </div>

  <h3>Consignments</h3>
  <div>
    <table class="table table-hover table-bordered">
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
          <td><a href="/consignments/{{$consignment->BOL}}"
              class="btn btn-success">View Consignment</a></td>
        </tr>
      @endforeach

    </table>
    <a href="/consignments/create/{{$lc->lc_num}}" class="btn btn-primary">Add Consignment</a>
  </div>

</div> <!-- container accordion -->


@endsection
