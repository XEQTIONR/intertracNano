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
    <label for="LcNumber" class="col-md-3 col-md-offset-2 control-label">LC#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="LcNumber" id="inputLCnum" value="{{old('LcNumber')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="DateIssued" class="col-md-3 col-md-offset-2 control-label">Date Issued</label>
    <div class="col-md-2">
      <input type="text"  class="form-control pickdate" name="DateIssued" id="inputDateIssue" value="{{old('DateIssued')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="DateExpiry" class="col-md-3 col-md-offset-2 control-label">Date Expiry</label>
    <div class="col-md-2">
      <input type="text" class="form-control pickdate" name="DateExpiry" id="inputDateExpiry" value="{{old('DateExpiry')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="Applicant" class="col-md-3 col-md-offset-2 control-label">Applicant</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="Applicant" id="inputApplicant" value="{{old('Applicant')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="Beneficiary" class="col-md-3 col-md-offset-2 control-label">Beneficiary</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="Beneficiary" id="inputBeneficiary" value="{{old('Beneficiary')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="PortDepart" class="col-md-3 col-md-offset-2 control-label">Departing Port</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="PortDepart" id="inputPortDepart" value="{{old('PortDepart')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="PortArrive" class="col-md-3 col-md-offset-2 control-label">Arrival Port</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="PortArrive" id="inputPortArrive" value="{{old('PortArrive')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="Invoice" class="col-md-3 col-md-offset-2 control-label">Invoice#</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="Invoice" id="inputInvoice" value="{{old('Invoice')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="CurrencyCode" class="col-md-3 col-md-offset-2 control-label">Foreign Currency Code</label>
    <div class="col-md-2">
      <input type="text" class="form-control" name="CurrencyCode" id="inputCurrencyCode" value="{{old('CurrencyCode')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="ExchangeRate" class="col-md-3 col-md-offset-2 control-label">Exchange Rate</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="ExchangeRate" id="inputExchangeRate" value="{{old('ExchangeRate')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="Value" class="col-md-3 col-md-offset-2 control-label">LC Value (Foreign Amount)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="Value" id="inputValue" value="{{old('Value')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="ForeignExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Foreign)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="ForeignExpense" id="inputForeignExpense" value="{{old('ForeignExpense')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="LocalExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Local)</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="LocalExpense" id="inputLocalExpense" value="{{old('LocalExpense')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="Notes" class="col-md-3 col-md-offset-2 control-label">Notes</label>
    <div class="col-md-3">
      <textarea rows="5" class="form-control" name="Notes" id="inputNotes" >{{old('Notes')}}</textarea>
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
