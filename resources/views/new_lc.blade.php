@extends('layout.mainlayout')

@section('scripts')
<style>
  .input{
    width : 33%;
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection


@section('content')

<div class="container">
  <div class="row">
  <div class="col-md-10 col-md-offset-1">

<form class="form-horizontal" method="post" action="/lcs">

  {{ csrf_field() }}

  @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    </div>
  @endif


  <div class="form-group">
    <label for="inputLCnum" class="col-md-3 col-md-offset-2 control-label">LC#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="InputLcNum" id="inputLCnum">
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
  <button class="btn btn-danger" type="button" onclick="removeItem()">Remove Last Item</button> <br><br><br>



  <div id="itemList" class="well col-md-6">
    <h4>Enter Performa Invoice</h4><br>
  </div>

  <div class="col-md-6">
    <h4>Tyre Catalog</h4> <br>
    <table class="table table-hover">
      <thead>
      <tr>
        <th>tyre_id</th>
        <th>Tyre Brand</th>
        <th>Tyre Size</th>
        <th>Tyre Pattern</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($tyres as $tyre)
      <tr>
        <td>{{$tyre->tyre_id}}</td>
        <td>{{$tyre->brand}}</td>
        <td>{{$tyre->size}}</td>
        <td>{{$tyre->pattern}}</td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>





</div>
</div>

<div class="form-group row">
  <label for="numItems" class="col-md-2 col-md-offset-1 control-label">Num items</label>
  <div class="col-md-1">
    <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
  </div>
</div>

</form>


</div>
@endsection
