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
        <h1>Consignment information</h1>
      </div>
    </div>
  </div>

  <div class="row">
  <div class="col-md-4 col-md-push-4">
  <dl class="dl-horizontal">

    <dt>Bill of Lading#</dt>
    <dd>{{$consignment->BOL}}</dd>

    <dt>LC#</dt>
    <dd><a href="/lcs/{{$consignment->lc}}">{{$consignment->lc}}</a></dd>

    <dt>Landed On</dt>
    <dd>{{$consignment->land_date}}</dd>

    <dt>Exchange_rate</dt>
    <dd>{{$consignment->exchange_rate}}</dd> {{--Change 60 to exchange_rate--}}

    <dt>Total Value (Foreign)</dt>
    <dd>{{$consignment->value}}</dd>

    <dt>Total Value (Local)</dt>
    <dd>{{$consignment->value * $consignment->exchange_rate}}</dd> {{--change 60 to excahnge rate--}}

    <dt>Total Tax Charged (TK)</dt>
    <dd>{{$consignment->tax}}</dd>
  </div> <!--col-->
  </div> <!--row-->
</div> <!--container-->

  {{-- view containers section--}}

<div id="accordion" class="container">

  <h3>Containers</h3>
  <div>
      @foreach ($containers as $container)
        <div class="panel panel-default">
          <div class="panel-heading">Container# {{$container->Container_num}}</div>
            <div class="panel-body">
              @foreach ($contents as $content_one_container) {{--each container--}}
                {{--@ means if not empty--}}
                @if (@$content_one_container[0]->Container_num==$container->Container_num) {{-- if this container add BOL later --}}
                  @foreach($content_one_container as $listing) {{---each tyre qty price etc--}}
                    <span>{{$listing->tyre_id}}</span>
                    <span>{{$listing->qty}}</span>
                    <span>{{$listing->unit_price}}</span><br>
                  @endforeach
                @endif
              @endforeach
            </div>
          </div>
      @endforeach

      <a href="/container_contents/create/{{$consignment->BOL}}" class="btn btn-primary">Add a container</a>

  </div>



  <h3>Expenses</h3>
  <div>
    @foreach($expenses as $expense)
      <span>{{$expense->expense_id}}</span>
      <span>{{$expense->expense_local}}</span>
      <span>{{$expense->expense_foreign}}</span>
      <span>{{$expense->expense_notes}}</span> <br>
    @endforeach
    <a href="/consignment_expenses/create/{{$consignment->BOL}}" class="btn btn-primary">Add an expense</a>
  </div>

</div> <!--accordion-->


@endsection
