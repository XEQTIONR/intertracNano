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

<script type="text/javascript">

$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/spinner.gif" />');

        var url = $(this).attr('href');
        getTyres(url);
        window.history.pushState("", "", url);
    });

    function getTyres(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('#tyreCatalog').html(data);
        }).fail(function () {
            alert('Tyres Catalog could not be loaded.');
        });
    }
});

</script>

<script src="/js/addItem.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection


@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <form class="form-horizontal" method="post" action="/lcs">
        {{ csrf_field() }}

        @if ($errors->any())
          <div class="alert alert-danger" role="alert">

              @foreach ($errors->all() as $error)

                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{$error}}<br>
              @endforeach

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

        <button class="btn btn-success" type="button" onclick="addItem()">Add New Item</button>
        <button class="btn btn-danger" type="button" onclick="removeItem()">Remove Last Item</button>
        <button class="btn btn-info" type="submit" value="submit">Submit</button><br><br><br>


        <div class="well col-md-5">

          <div id="itemList" class="row">
            <h4>Enter Performa Invoice</h4>
            <span>None of the fields can be blank</span>
          </div><!--row-->

          <div class="form-group row">
            <label for="numItems" class="col-md-4 control-label">Num items</label>
            <div class="col-md-4">
              <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
            </div>
          </div>



        </div> <!--well col-md-6-->


        <div id=catalogContainer class="col-md-6 col-md-offset-1 well">
          <div id="row">
            <h4>Tyre Catalog</h4>
          </div> <!--row-->

          <div id="row">
            <div id="tyreCatalog" class="col-md-12">
              @include('partials.tyres')
            </div>
          </div> <!--row-->
        </div> <!--catalogContainer-->







      </form>
    </div> <!--col-->
  </div> <!--row-->
</div> <!--container-->
@endsection
