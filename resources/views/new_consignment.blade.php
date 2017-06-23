@extends('layout.mainlayout')

@section('scripts')

<script>
$( function()
  {
    $( ".pickdate" ).datepicker();

    $(".pickdate").datepicker("option", "dateFormat", "yy-mm-dd");
  });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('content')

<div class="container">


<form method="post" action="/consignments">
<div class="row">
  {{ csrf_field() }}

  <div class="form-group">
    <label for="inputBOL" class="col-md-3 col-md-offset-2 control-label">BOL#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputBOL" id="inputBOL">
    </div>
  </div>



  <div class="form-group">
    <label for="inputLCnum" class="col-md-3 col-md-offset-2 control-label">LC#</label>
    <div class="col-md-3">
      @if ($lc_num=="")
        <input type="text" class="form-control" name="inputLCnum" id="inputLCnum">
      @else
        <input type="text" class="form-control" name="inputLCnum" id="inputLCnum" value="{{$lc_num}}" readonly>
      @endif

    </div>
  </div>

  <div class="form-group">
    <label for="inputValue" class="col-md-3 col-md-offset-2 control-label">Value($)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputValue" id="inputValue">
    </div>
  </div>

  <div class="form-group">
    <label for="inputExchangeRate" class="col-md-3 col-md-offset-2 control-label">Exchange Rate</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputExchangeRate" id="inputExchangeRate">
    </div>
  </div>

  <div class="form-group">
    <label for="inputTax" class="col-md-3 col-md-offset-2 control-label">Tax Paid</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputTax" id="inputTax">
    </div>
  </div>

  <div class="form-group">
    <label for="inputLandDate" class="col-md-3 col-md-offset-2 control-label">Land Date</label>
    <div class="col-md-3">
      <input type="text" class="form-control pickdate" name="inputLandDate" id="inputLandDate">
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-3 col-md-offset-2">
    <button type="submit" value="submit">Submit</button>
  </div>
</div>
</form>


</div>

@endsection
