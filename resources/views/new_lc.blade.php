@extends('layouts.app')

@section('title')
  Letters of credit
@endsection
@section('subtitle')
  All LCs applied for.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Letters of Credit',
    'subcrumb' => 'All LCs',
     'link' => route('lcs.index')])
  @endcomponent
@endsection

@section('body')

  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">1. Enter LC Information</h3>
        </div>
        <div class="box-body">

          <form id="lcForm">
            <div class="box-body">

              <div class="col-xs-12">
                <div class="form-group">
                  <label>LC#</label>
                  <div class="input-group">
                    <span class="input-group-addon">F20</span>
                    <input type="text" class="form-control" placeholder="Enter letter of credit number">
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>Date Issued</label>
                  <div class="input-group">
                    <span class="input-group-addon">F31C</span>
                    <input type="text" class="form-control date">
                    <div class="input-group-addon">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>Date Expiry</label>
                  <div class="input-group">
                    <span class="input-group-addon">F31D</span>
                    <input type="text" class="form-control date">
                    <div class="input-group-addon">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label>Applicant</label>
                  <div class="input-group">
                    <span class="input-group-addon">F31D</span>
                    <textarea class="form-control" rows="3" placeholder="Enter applicant name and address"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label>Beneficiary</label>
                  <div class="input-group">
                    <span class="input-group-addon">F50</span>
                    <textarea class="form-control" rows="3" placeholder="Beneficiary name and address"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label>Departing Port</label>
                  <div class="input-group">
                    <span class="input-group-addon">F44E</span>
                    <input type="text" class="form-control" placeholder="Enter departing port">
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label>Arriving Port</label>
                  <div class="input-group">
                    <span class="input-group-addon">F44F</span>
                    <input type="text" class="form-control" placeholder="Enter departing port">
                  </div>
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label>Foreign currency code</label>
                  <div class="input-group">
                    <span class="input-group-addon">F32B</span>
                    <input type="number" class="form-control" placeholder="Currency Code">
                  </div>
                </div>
              </div>

              <div class="col-xs-8">
                <div class="form-group">
                  <label>LC Value (in foreign currency)</label>
                  <div class="input-group">
                    <span class="input-group-addon"><strong>$</strong></span>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                  </div>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label>Exchange Rate</label>
                  <div class="input-group">

                    <input type="number" step="0.01" class="form-control" placeholder="0.00">
                    <span class="input-group-addon"><strong>/ $</strong></span>
                  </div>
                </div>
              </div>

              <div class="col-xs-8">
                <div class="form-group">
                  <label>LC Value (in local currency) </label>
                  <div class="input-group">
                    <span class="input-group-addon"><strong>৳</strong></span>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00" disabled>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>Expenses Paid (Foreign)</label>
                  <div class="input-group">
                    <span class="input-group-addon"><strong>$</strong></span>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>Expenses Paid (Local)</label>
                  <div class="input-group">
                    <span class="input-group-addon"><strong>৳</strong></span>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label>Notes</label>
                  {{--<div class="input-group">--}}
                    {{--<span class="input-group-addon">F50</span>--}}
                    <textarea v-model="notes" class="form-control" rows="3" placeholder="Any additonal information you want to record about this LC"></textarea>
                  {{--</div>--}}

                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
                </div>
              </div>



                <!-- /.input group -->

              {{--<label for="LcNumber" class="col-md-3 col-md-offset-2 control-label">LC#  <small>F20</small></label>--}}
              {{--<div class="col-md-3">--}}
                {{--<input type="text" class="form-control" name="LcNumber" id="inputLCnum" value="{{old('LcNumber')}}" required>--}}
              {{--</div>--}}
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer-scripts')
  <script>
    var lcApp = new Vue({
        el: '#lcForm',
        data: {
            notes : ''
        }
    })
  </script>
@endsection


{{--@extends('layout.mainlayout')--}}

{{--@section('scripts')--}}
{{--<style>--}}
  {{--.input{--}}
    {{--width : 25%;--}}
  {{--}--}}

  {{--label small{--}}
    {{--color : #999;--}}
    {{--font-weight: lighter;--}}
  {{--}--}}

  {{--.tyreDiv span{--}}
    {{--float : right;--}}
    {{--width : 10%;--}}
  {{--}--}}

  {{--#GrandTotal{--}}
    {{--text-align: right;--}}
  {{--}--}}
{{--</style>--}}

{{--<script>--}}
{{--$( function()--}}
  {{--{--}}
    {{--$( ".pickdate" ).datepicker();--}}
    {{--$(".pickdate").datepicker("option", "dateFormat", "yy-mm-dd");--}}
  {{--});--}}
{{--</script>--}}

{{--<script src="/js/addItem.js"></script>--}}
{{--<script src="/js/spinner.js"></script>--}}

{{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
{{--<link rel="stylesheet" href="/resources/demos/style.css">--}}
{{--@endsection--}}


{{--@section('content')--}}

{{--<div class="container">--}}

  {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
      {{--<div class="page-header">--}}
        {{--<h1>New LC <small>Enter new LC information.</small></h1>--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}

  {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}

      {{--<form class="form-horizontal" method="post" action="/lcs">--}}
        {{--{{ csrf_field() }}--}}

        {{--@include('partials.errors')--}}

        {{--<!--<div class="panel panel-default" style="margin-top: 1.6em;">--}}
        {{--<div class="panel-heading">1. LC Information</div>--}}
        {{--<div class="panel-body">-->--}}
        {{--<div class="form-group">--}}
          {{--<label for="LcNumber" class="col-md-3 col-md-offset-2 control-label">LC#  <small>F20</small></label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="LcNumber" id="inputLCnum" value="{{old('LcNumber')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="DateIssued" class="col-md-3 col-md-offset-2 control-label">Date Issued <small>F31C</small></label>--}}
          {{--<div class="col-md-2">--}}
            {{--<input type="text"  class="form-control pickdate" name="DateIssued" id="inputDateIssue" value="{{old('DateIssued')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="DateExpiry" class="col-md-3 col-md-offset-2 control-label">Date Expiry <small>F31D</small></label>--}}
          {{--<div class="col-md-2">--}}
            {{--<input type="text" class="form-control pickdate" name="DateExpiry" id="inputDateExpiry" value="{{old('DateExpiry')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="Applicant" class="col-md-3 col-md-offset-2 control-label">Applicant <small>F50</small></label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="Applicant" id="inputApplicant" value="{{old('Applicant')}}" required>--}}
            {{--<textarea rows="5" class="form-control" name="Applicant" id="inputApplicant" required>{{old('Applicant')}}</textarea>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="Beneficiary" class="col-md-3 col-md-offset-2 control-label">Beneficiary <small>F59</small></label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="Beneficiary" id="inputBeneficiary" value="{{old('Beneficiary')}}" required>--}}
            {{--<textarea rows="5" class="form-control" name="Beneficiary" id="inputBeneficiary" required>{{old('Beneficiary')}}</textarea>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="PortDepart" class="col-md-3 col-md-offset-2 control-label">Departing Port <small>F44E</small></label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="PortDepart" id="inputPortDepart" value="{{old('PortDepart')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="PortArrive" class="col-md-3 col-md-offset-2 control-label">Arrival Port <small>F44F</small></label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="PortArrive" id="inputPortArrive" value="{{old('PortArrive')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="CurrencyCode" class="col-md-3 col-md-offset-2 control-label">Foreign Currency Code <small>F32B</small></label>--}}
          {{--<div class="col-md-2">--}}
            {{--<input type="text" class="form-control" name="CurrencyCode" id="inputCurrencyCode" value="{{old('CurrencyCode')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="Value" class="col-md-3 col-md-offset-2 control-label">LC Value (Foreign Amount)</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="Value" id="inputValue" value="{{old('Value')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="ExchangeRate" class="col-md-3 col-md-offset-2 control-label">Exchange Rate</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="ExchangeRate" id="inputExchangeRate" value="{{old('ExchangeRate')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="Invoice" class="col-md-3 col-md-offset-2 control-label">Invoice#</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="Invoice" id="inputInvoice" value="{{old('Invoice')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="ForeignExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Foreign)</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="ForeignExpense" id="inputForeignExpense" value="{{old('ForeignExpense')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="LocalExpense" class="col-md-3 col-md-offset-2 control-label">Expenses Paid (Local)</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<input type="text" class="form-control" name="LocalExpense" id="inputLocalExpense" value="{{old('LocalExpense')}}" required>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
          {{--<label for="Notes" class="col-md-3 col-md-offset-2 control-label">Notes</label>--}}
          {{--<div class="col-md-3">--}}
            {{--<textarea rows="5" class="form-control" name="Notes" id="inputNotes" >{{old('Notes')}}</textarea>--}}
          {{--</div>--}}
        {{--</div>--}}

      {{--<!--</div> panel-body-->--}}
    {{--<!--</div> panel-->--}}



        {{--<!--<div class="panel panel-default">--}}
        {{--<div class="panel-heading"> 2. Enter Peforma Invoice Information (Optional)</div>--}}
        {{--<div class="panel-body">-->--}}


        {{--<div class="col-md-5">--}}
          {{--<div id="itemList">--}}
            {{--<div class="row">--}}
              {{--<div id="col-md-12">--}}
                {{--<h4>Enter Proforma Invoice</h4>--}}
                {{--<span>None of the fields can be blank</span>--}}
                  {{--<!-- Javascript adds fields here-->--}}
                {{--</div><!--col-->--}}
              {{--</div><!--row-->--}}
          {{--</div><!--itemList-->--}}
          {{--<hr>--}}
          {{--<div class="row">--}}
            {{--<div class="col-md-3">--}}
              {{--TOTAL--}}
            {{--</div>--}}
            {{--<div id="QtyTotal" class="col-md-3">--}}

            {{--</div>--}}
            {{--<div id= "GrandTotal" class="col-md-3 col-md-offset-3">--}}
            {{--</div>--}}
          {{--</div>--}}

          {{--<div class="row">--}}
            {{--<div class="form-group">--}}
              {{--<label for="numItems" class="col-md-4 control-label">Num items</label>--}}
              {{--<div class="col-md-4">--}}
                {{--<input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div> <!--row-->--}}



          {{--<div class="row">--}}
            {{--<button class="btn btn-default" type="button" onclick="addItem()">Add New Item</button>--}}
            {{--<button class="btn btn-info" type="submit" value="submit">Submit</button><br><br><br>--}}
          {{--</div>--}}
        {{--</div> <!--col-md-5-->--}}


        {{--<div id=catalogContainer class="col-md-6 col-md-offset-1">--}}
          {{--<!--<div class="panel panel-success">--}}
            {{--<div class="panel-heading">-->--}}
              {{--<h4>Tyre Catalog</h4>--}}
            {{--<!--</div> panel-heading--}}

            {{--<div class="panel-body">-->--}}
              {{--<div id="tyreCatalog" class="col-md-12">--}}
                {{--@include('partials.tables.tyre_catalog')--}}
              {{--</div>--}}
            {{--</div> <!--panel-body-->--}}
          {{--</div> <!--panel-->--}}
        {{--</div> <!--catalogContainer-->--}}


  {{--<!--  </div> panel-body-->--}}
  {{--<!--</div> panel-->--}}
    {{--<input type="hidden" id="removedDivs" name="removedDivs" value="">--}}
    {{--<input type="hidden" id="runningCount" name="runningCount" value=""> --}}





      {{--</form>--}}
    {{--</div> <!--col-->--}}
  {{--</div> <!--row-->--}}
{{--</div> <!--container-->--}}
{{--@endsection--}}
