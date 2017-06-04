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

<div class="leftDiv">
<form method="post" action="/orders">

  {{ csrf_field() }}

  Customer ID <input type="text" name="inputCustomerId"> <br>
  Discount % <input type="text"  name="inputDiscountPercent"> <br>
  Discount Amount <input type="text" name="inputDiscountAmount"> <br>
  Tax % <input type="text" name="inputTaxPercent"> <br>
  Tax Amount <input type="text" name="inputTaxAmount"> <br>

  <button type="button" onclick="addItem()">Add New Item</button>
  <button type="submit" value="submit">Submit</button>
  <button type="button" onclick="removeItem()">Remove Last Item</button>

  <div id="itemList" style="border: 2px dashed black;"></div> <br>

  Num items <input type="text"  name="numItems" id="numItems" readonly>


</form>
</div> <!-- leftDiv -->

<div class="rightDiv">
  @include('partials.currentstock');
</div>
@endsection
