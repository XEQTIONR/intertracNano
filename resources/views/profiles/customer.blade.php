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

<div class="container">
<div class="row">
<div class="col-md-6 col-md-push-3">
  <dl class="dl-horizontal">
    <dt>Customer ID</dt>
    <dd>{{$customer->id}}</dd>

    <dt>Customer/Party Name</dt>
    <dd>{{$customer->name}}</dd>

    <dt>Address</dt>
    <dd>{{$customer->address}}</dd>

    <dt>Phone #</dt>
    <dd>{{$customer->phone}}</dd>

    <dt>Notes</dt>
    <dd>{{$customer->notes}}</dd>

    <dt>created_at</dt>
    <dd>{{$customer->created_at}}</dd>

    <dt>updated_at</dt>
    <dd>{{$customer->updated_at}}</dd>
  </dl>
</div> <!--col-->
</div> <!--row-->
</div> <!--container-->


<div id="accordion" class="container">

  <h3>Order History</h3>
  <div>
    <table class="table table-hover table-bordered">
      <tr>
        <th>Order#</th>
        <th>Date</th>
        <th>Total Value</th>
      </tr>

      @foreach($orders as $order)
        <tr>
          <td>{{$order->Order_num}}</td>
          <td>{{$order->created_at}}</td>
          <td></td>

          <td><a href="/orders/{{$order->Order_num}}"
              class="btn btn-success">More Info</a></td>
        </tr>
      @endforeach

    </table>
  </div>

  <h3>Payment History</h3>
  <div>
    <table class="table table-hover table-bordered">
      <tr>
        <th>Order #</th>
        <th>Invoice #</th>
        <th>Total Amount</th>
        <th>Payment Date</th>
      </tr>

      @foreach($payments as $payment)
        <tr>
          <td>{{$payment->Invoice_num}}</td>
          <td>{{$payment->Order_num}}</td>
          <td>{{$payment->payment_amount}}</td>
          <td>{{$payment->created_at}}</td>

          {{--<td><a href="#"
              class="btn btn-success">New Payment</a></td>--}}
        </tr>
      @endforeach

    </table>

    <a href="/consignments/create/" class="btn btn-primary">Add Consignment</a>
  </div>

</div> <!-- container accordion -->


@endsection
