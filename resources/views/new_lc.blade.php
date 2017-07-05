@extends('layout.mainlayout')

@section('scripts')
<style>
  .input{
    width : 33%;
  }

  label small{
    color : #999;
    font-weight: lighter;
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

        <div class="panel panel-default" style="margin-top: 1.6em;">
        <div class="panel-heading">1. LC Information</div>
        <div class="panel-body">
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
            <input type="text" class="form-control" name="Applicant" id="inputApplicant" value="{{old('Applicant')}}" required>
          </div>
        </div>

        <div class="form-group">
          <label for="Beneficiary" class="col-md-3 col-md-offset-2 control-label">Beneficiary <small>F59</small></label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="Beneficiary" id="inputBeneficiary" value="{{old('Beneficiary')}}" required>
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

      </div> <!--panel-body-->
    </div> <!--panel-->



        <div class="panel panel-default">
        <div class="panel-heading"> 2. Enter Peforma Invoice Information (Optional)</div>
        <div class="panel-body">


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
          <br>
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
            <button class="btn btn-danger" type="button" onclick="removeItem()">Remove Last Item</button>
            <button class="btn btn-info" type="submit" value="submit">Submit</button><br><br><br>
          </div>
        </div> <!--col-md-5-->


        <div id=catalogContainer class="col-md-6 col-md-offset-1">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h4>Tyre Catalog</h4>
            </div> <!--panel-heading-->

            <div class="panel-body">
              <div id="tyreCatalog" class="col-md-12">
                @include('partials.tyres')
              </div>
            </div> <!--panel-body-->
          </div> <!--panel-->
        </div> <!--catalogContainer-->


    </div> <!--panel-body-->
  </div> <!--panel-->






      </form>
    </div> <!--col-->
  </div> <!--row-->
</div> <!--container-->
@endsection
