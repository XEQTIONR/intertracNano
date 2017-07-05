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
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

  <form class="form-horizontal" method="post" action="/consignments">

    <div class="panel panel-default" style="margin-top: 1.6em;">



      <div class="panel-heading">1. Enter New Consignment Information </div>
      <div class="panel-body">

            <div class="row">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="inputBOL" class="col-md-4 col-md-offset-1 control-label">BOL#</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="inputBOL" id="inputBOL">
                </div>
              </div>



              <div class="form-group">
                <label for="inputLCnum" class="col-md-4 col-md-offset-1 control-label">LC#</label>
                <div class="col-md-4">
                  @if ($lc_num=="")
                    <input type="text" class="form-control" name="inputLCnum" id="inputLCnum">
                  @else
                    <input type="text" class="form-control" name="inputLCnum" id="inputLCnum" value="{{$lc_num}}" readonly>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="inputValue" class="col-md-4 col-md-offset-1 control-label">Value($)</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="inputValue" id="inputValue">
                </div>
              </div>

              <div class="form-group">
                <label for="inputExchangeRate" class="col-md-4 col-md-offset-1 control-label">Exchange Rate</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="inputExchangeRate" id="inputExchangeRate">
                </div>
              </div>

              <div class="form-group">
                <label for="inputTax" class="col-md-4 col-md-offset-1 control-label">Tax Paid</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="inputTax" id="inputTax">
                </div>
              </div>

              <div class="form-group">
                <label for="inputLandDate" class="col-md-4 col-md-offset-1 control-label">Land Date</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control pickdate" name="inputLandDate" id="inputLandDate">
                  </div>
              </div>

            </div><!--row-->

            <div class="row">
              <div class="col-md-3 col-md-offset-5">
                <button class="btn btn-primary" type="submit" value="submit">Next Step</button>
              </div>
            </div><!--row-->


      </div> <!--panel-body-->
    </div> <!--panel-->


  </form>
</div><!--col-->
</div> <!--row-->
</div><!--contaier-->

@endsection
