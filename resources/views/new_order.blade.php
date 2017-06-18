@extends('layout.mainlayout')

@section('scripts')
  <style>
    .leftDiv{
      width : 50%;
      float : left;
      margin : auto;
    }
    .rightDiv{
      width : 50%;
      float : right;
      margin : auto;
    }

  </style>
  <script src="/js/addItem.js"></script>
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-md-7">

<form class="form-horizontal" method="post" action="/orders">

  {{ csrf_field() }}

  <div class="form-group">
    <label for="inputCustomerId" class="col-md-3 control-label">Customer ID</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputCustomerId" id="inputCustomerId">
    </div>
  </div>

  <div class="form-group">
    <label for="inputDiscountPercent" class="col-md-3 control-label">Discount %</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputDiscountPercent" id="inputDiscountPercent">
    </div>
  </div>

  <span class="col-md-3 col-md-offset-3"><i>and / or</i></span><br>

  <div class="form-group">
    <label for="inputDiscountAmount" class="col-md-3 control-label">Discount Amount</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputDiscountAmount" id="inputDiscountAmount">
    </div>
  </div>


  <div class="form-group">
    <label for="inputTaxPercent" class="col-md-3 control-label">Tax %</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputTaxPercent" id="inputTaxPercent">
    </div>
  </div>

  <span class="col-md-3 col-md-offset-3"><i>and / or</i></span><br>

  <div class="form-group">
    <label for="inputTaxAmount" class="col-md-3 control-label">Tax Amount</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="inputTaxAmount" id="inputTaxAmount">
    </div>
  </div>



  <button type="button" onclick="addItem()">Add New Item</button>
  <button type="submit" value="submit">Submit</button>
  <button type="button" onclick="removeItem()">Remove Last Item</button>

  <div id="itemList" style="border: 2px dashed black;"></div> <br>


  <div class="form-group">
    <label for="inputTaxAmount" class="col-md-3 control-label">Num items</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
    </div>
  </div>


</form>
</div> <!--col-->


<div class="col-md-5">
  @include('partials.currentstock')
</div>
</div> <!-- row -->
</div> <!--container-->
@endsection
