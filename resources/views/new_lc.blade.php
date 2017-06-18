@extends('layout.mainlayout')

@section('scripts')

<script>
$( function()
  {
    $( ".pickdate" ).datepicker();

    $(".pickdate").datepicker("option", "dateFormat", "yy-mm-dd");
  });
</script>

<script src="/js/addItem.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('content')

<div class="container">
  <div class="row">
  <div class="col-md-10 col-md-offset-1">

<form class="form-horizontal" method="post" action="/lcs" style="border: 1px solid black;">

  {{ csrf_field() }}




  <div class="form-group">
    <label for="inputLCnum" class="col-md-3 col-md-offset-2 control-label">LC#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputLCnum" id="inputLCnum">
    </div>
  </div>

  <div class="form-group">
    <label for="inputDateIssue" class="col-md-3 col-md-offset-2 control-label">Date Issued</label>
    <div class="col-md-2">
      <input type="text"  class="form-control pickdate" name="inputDateIssue" id="inputDateIssue">
    </div>
  </div>

  <div class="form-group">
    <label for="inputDateExpiry" class="col-md-3 col-md-offset-2 control-label">Date Expiry</label>
    <div class="col-md-2">
      <input type="text" class="form-control pickdate" name="inputDateExpiry" id="inputDateExpiry">
    </div>
  </div>

  <div class="form-group">
    <label for="inputApplicant" class="col-md-3 col-md-offset-2 control-label">Applicant</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputApplicant" id="inputApplicant">
    </div>
  </div>

  <div class="form-group">
    <label for="inputBeneficiary" class="col-md-3 col-md-offset-2 control-label">Beneficiary</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputBeneficiary" id="inputBeneficiary">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPortDepart" class="col-md-3 col-md-offset-2 control-label">Departing Port</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputPortDepart" id="inputPortDepart">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPortArrive" class="col-md-3 col-md-offset-2 control-label">Arrival Port</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputPortArrive" id="inputPortArrive">
    </div>
  </div>

  <div class="form-group">
    <label for="inputInvoice" class="col-md-3 col-md-offset-2 control-label">Invoice#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputInvoice" id="inputInvoice">
    </div>
  </div>

  <div class="form-group">
    <label for="inputCurrencyCode" class="col-md-3 col-md-offset-2 control-label">Foreign Currency Code</label>
    <div class="col-md-2">
      <input type="text" class="form-control" name="inputCurrencyCode" id="inputCurrencyCode">
    </div>
  </div>

  <div class="form-group">
    <label for="inputExchangeRate" class="col-md-3 col-md-offset-2 control-label">Exchange Rate </label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputExchangeRate" id="inputExchangeRate">
    </div>
  </div>

  <div class="form-group">
    <label for="inputValue" class="col-md-3 col-md-offset-2 control-label">LC Value (Foreign Amount)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputValue" id="inputValue">
    </div>
  </div>

  <div class="form-group">
    <label for="inputForeignExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Foreign)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputForeignExpense" id="inputForeignExpense">
    </div>
  </div>

  <div class="form-group">
    <label for="inputLocalExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Local)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputLocalExpense" id="inputLocalExpense">
    </div>
  </div>


  <button class="btn btn-warning" type="button" onclick="addItem()">Add New Item</button>
  <button class="btn btn-success" type="submit" value="submit">Submit</button>
  <button class="btn btn-danger" type="button" onclick="removeItem()">Remove Last Item</button>

  <div id="itemList" style="border: 2px dashed black;"></div> <br>

  <div class="form-group">
    <label for="numItems" class="col-md-3 col-md-offset-2 control-label">Num items</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
    </div>
  </div>


</form>
</div>
</div>
</div>
@endsection
