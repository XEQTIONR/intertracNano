@extends('layout.mainlayout')

@section('scripts')
<style>
  .input{
    width : 25%;
  }

  label small{
    color : #999;
    font-weight: lighter;
  }

  .tyreDiv span{
    float : right;
    width : 10%;
  }

  #GrandTotal{
    text-align: right;
  }
</style>

<script>
$( function()
  {
    $( ".pickdate" ).datepicker();
    $(".pickdate").datepicker("option", "dateFormat", "yy-mm-dd");
  });
</script>

<script src="/js/addItem.js"></script>
<script src="/js/spinner.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection


@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>New LC <small>Enter new LC information.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <form class="form-horizontal" method="post" action="/lcs">
        {{ csrf_field() }}

        @include('partials.errors')

        <!--<div class="panel panel-default" style="margin-top: 1.6em;">
        <div class="panel-heading">1. LC Information</div>
        <div class="panel-body">-->
        <div class="form-group">
          <label for="LcNumber" class="col-md-3 col-md-offset-2 control-label">LC#  <small>F20</small></label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="LcNumber" id="inputLCnum" value="{{old('LcNumber')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="DateIssued" class="col-md-3 col-md-offset-2 control-label">Date Issued <small>F31C</small></label>
          <div class="col-md-2">
            <input type="text"  class="form-control pickdate" name="DateIssued" id="inputDateIssue" value="{{old('DateIssued')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="DateExpiry" class="col-md-3 col-md-offset-2 control-label">Date Expiry <small>F31D</small></label>
          <div class="col-md-2">
            <input type="text" class="form-control pickdate" name="DateExpiry" id="inputDateExpiry" value="{{old('DateExpiry')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="Applicant" class="col-md-3 col-md-offset-2 control-label">Applicant <small>F50</small></label>
          <div class="col-md-3">
            {{--<input type="text" class="form-control" name="Applicant" id="inputApplicant" value="{{old('Applicant')}}" required>--}}
            <textarea rows="5" class="form-control" name="Applicant" id="inputApplicant" required>{{old('Applicant')}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="Beneficiary" class="col-md-3 col-md-offset-2 control-label">Beneficiary <small>F59</small></label>
          <div class="col-md-3">
            {{--<input type="text" class="form-control" name="Beneficiary" id="inputBeneficiary" value="{{old('Beneficiary')}}" required>--}}
            <textarea rows="5" class="form-control" name="Beneficiary" id="inputBeneficiary" required>{{old('Beneficiary')}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="PortDepart" class="col-md-3 col-md-offset-2 control-label">Departing Port <small>F44E</small></label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="PortDepart" id="inputPortDepart" value="{{old('PortDepart')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="PortArrive" class="col-md-3 col-md-offset-2 control-label">Arrival Port <small>F44F</small></label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="PortArrive" id="inputPortArrive" value="{{old('PortArrive')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="CurrencyCode" class="col-md-3 col-md-offset-2 control-label">Foreign Currency Code <small>F32B</small></label>
          <div class="col-md-2">
            <input type="text" class="form-control" name="CurrencyCode" id="inputCurrencyCode" value="{{old('CurrencyCode')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="Value" class="col-md-3 col-md-offset-2 control-label">LC Value (Foreign Amount)</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="Value" id="inputValue" value="{{old('Value')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="ExchangeRate" class="col-md-3 col-md-offset-2 control-label">Exchange Rate</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="ExchangeRate" id="inputExchangeRate" value="{{old('ExchangeRate')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="Invoice" class="col-md-3 col-md-offset-2 control-label">Invoice#</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="Invoice" id="inputInvoice" value="{{old('Invoice')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="ForeignExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Foreign)</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="ForeignExpense" id="inputForeignExpense" value="{{old('ForeignExpense')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="LocalExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Local)</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="LocalExpense" id="inputLocalExpense" value="{{old('LocalExpense')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="Notes" class="col-md-3 col-md-offset-2 control-label">Notes</label>
          <div class="col-md-3">
            <textarea rows="5" class="form-control" name="Notes" id="inputNotes" >{{old('Notes')}}</textarea>
          </div>
        </div>

      <!--</div> panel-body-->
    <!--</div> panel-->



        <!--<div class="panel panel-default">
        <div class="panel-heading"> 2. Enter Peforma Invoice Information (Optional)</div>
        <div class="panel-body">-->


        <div class="col-md-5">
          <div id="itemList">
            <div class="row">
              <div id="col-md-12">
                <h4>Enter Performa Invoice</h4>
                <span>None of the fields can be blank</span>
                  <!-- Javascript adds fields here-->
                </div><!--col-->
              </div><!--row-->
          </div><!--itemList-->
          <hr>
          <div class="row">
            <div class="col-md-3">
              TOTAL
            </div>
            <div id="QtyTotal" class="col-md-3">

            </div>
            <div id= "GrandTotal" class="col-md-3 col-md-offset-3">
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="numItems" class="col-md-4 control-label">Num items</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
              </div>
            </div>
          </div> <!--row-->



          <div class="row">
            <button class="btn btn-default" type="button" onclick="addItem()">Add New Item</button>
            <button class="btn btn-info" type="submit" value="submit">Submit</button><br><br><br>
          </div>
        </div> <!--col-md-5-->


        <div id=catalogContainer class="col-md-6 col-md-offset-1">
          <!--<div class="panel panel-success">
            <div class="panel-heading">-->
              <h4>Tyre Catalog</h4>
            <!--</div> panel-heading

            <div class="panel-body">-->
              <div id="tyreCatalog" class="col-md-12">
                @include('partials.tables.tyre_catalog')
              </div>
            </div> <!--panel-body-->
          </div> <!--panel-->
        </div> <!--catalogContainer-->


  <!--  </div> panel-body-->
  <!--</div> panel-->
    <input type="hidden" id="removedDivs" name="removedDivs" value="">
    <input type="hidden" id="runningCount" name="runningCount" value=""> 





      </form>
    </div> <!--col-->
  </div> <!--row-->
</div> <!--container-->
@endsection
