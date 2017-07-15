@extends('layout.mainlayout')

@section('scripts')
<style>
  .leftDiv{
    width : auto;
    float : left;
    margin : auto;
  }
  .rightDiv{
    width : auto;
    float : right;
    margin : auto;
  }

  .input{
    width : 15%;
  }

</style>
  <script>
  // javascript included in layout file.
  var count=0;
  function addItem()
  {

    //names of parameters.
    var itemId = "tyre[" + count + "]";
    var qty = "qty[" + count + "]";
    var price = "price[" + count + "]";
    var weight = "weight[" + count + "]";
    var tax = "tax[" + count + "]";

    var subDiv = document.createElement("DIV");
    var subDivId = "subDiv" + count;

    //Div for every new invice item
    subDiv.setAttribute("class", "tyreDiv");
    subDiv.setAttribute("id", subDivId);

    //document.getElementById("itemList").append(subDiv);
    //Items that go inside the Div
    var itemInput = document.createElement("INPUT");
    itemInput.setAttribute("type", "number");
    itemInput.setAttribute("min", "1");
    itemInput.setAttribute("class", "input");
    itemInput.setAttribute("name", itemId);
    itemInput.setAttribute("placeholder", "Tyre ID");
    itemInput.required = true;

    //document.getElementById(subDivNum).appendChild(itemInput);
    //$("#"+subDivId).append("Tyre ID: ");
    subDiv.appendChild(itemInput); //insert in the Div

    var qtyInput = document.createElement("INPUT");
    qtyInput.setAttribute("type", "number");
    qtyInput.setAttribute("min", "0");
    qtyInput.setAttribute("class", "input");
    qtyInput.setAttribute("name", qty);
    qtyInput.setAttribute("placeholder", "Quantity");
    qtyInput.setAttribute("onchange", "updateTotals()");
    qtyInput.required = true;

    //$("#"+subDivId).append("Quantity: ");
    subDiv.appendChild(qtyInput); //insert in the Div
    //document.getElementById(subDivNum).appendChild(qtyInput);

    var priceInput = document.createElement("INPUT");
    priceInput.setAttribute("type", "number");
    priceInput.setAttribute("min", "0");
    priceInput.setAttribute("step","0.01");
    priceInput.setAttribute("class", "input");
    priceInput.setAttribute("name", price);
    priceInput.setAttribute("placeholder", "Unit Price");
    priceInput.setAttribute("onchange", "updateTotals()");
    priceInput.required = true;
    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(priceInput); //insert in the Div
    //document.getElementById(subDivNum).appendChild(priceInput);

    var weightInput = document.createElement("INPUT");
    weightInput.setAttribute("type", "number");
    weightInput.setAttribute("min", "0");
    weightInput.setAttribute("step","0.01");
    weightInput.setAttribute("class", "input");
    weightInput.setAttribute("name", weight);
    weightInput.setAttribute("placeholder", "Total Weight");
    weightInput.required = true;
    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(weightInput); //insert in the Div

    var taxInput = document.createElement("INPUT");
    taxInput.setAttribute("type", "number");
    priceInput.setAttribute("min", "0");
    taxInput.setAttribute("class", "input");
    taxInput.setAttribute("name", tax);
    taxInput.setAttribute("placeholder", "Total Tax");
    itemInput.setAttribute("min", "0");
    taxInput.required = true;
    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(taxInput); //insert in the Div

    var subTotalLabel = document.createElement("SPAN");
    subTotalLabel.setAttribute("name", "subTotal");
    subTotalLabel.setAttribute("id", "subTotal"+count);


    subDiv.appendChild(subTotalLabel); //insert in the Div


    var itemlist = document.getElementById("itemList");

    itemlist.appendChild(subDiv);

    count++;
    document.getElementById("numItems").value = count;
  }

  function updateTotals()
  {
    var totalQty = 0;
    var grandTotal = 0;

    for (var i = 0; i<count; i++)
    {
      var qtyField = "qty[" + i + "]";
      var unitPriceField = "price[" + i + "]";
      var qty  = document.getElementsByName(qtyField)[0].value;
      var unitprice = document.getElementsByName(unitPriceField)[0].value;

      if (qty=="")
        qty=0;
      if(unitprice=="")
        unitprice=0;

        totalQty = parseInt(totalQty) + parseInt(qty);
        var subTotal =  Number(unitprice) * Number(qty);
        grandTotal+= Number(subTotal);
        document.getElementById("subTotal"+i).innerHTML = subTotal.toFixed(2);
    }
    document.getElementById("QtyTotal").innerHTML = totalQty;
    document.getElementById("GrandTotal").innerHTML = grandTotal.toFixed(2);
  }
  </script>
@endsection


@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>New Commercial Invoice <small>Record a stock information from new container imported.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      @include('partials.errors')

<div class="panel panel-default">
<div class="panel-heading">ENTER COMMERCIAL ITEMS INVOICE FOR CONSIGNMENT</div>

<div class="panel-body">
<div class="row">
<div class="col-md-6">
  <form class="form-horizontal" method="post" action="/container_contents">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="inputContainerNum" class="col-md-4 control-label">Container#</label>
      <div class="col-md-4">
        <input type="text" class="form-control" name="inputContainerNum" id="inputContainerNum">
      </div>
    </div>

    @if ($bol=="")
      <div class="form-group">
        <label for="inputBOL" class="col-md-4 control-label">BOL#</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="inputBOL" id="inputBOL">
        </div>
      </div>

    @else
      <div class="form-group">
        <label for="inputBOL" class="col-md-4 control-label">BOL#</label>
        <div class="col-md-4">
          <input type="text" value="{{$bol}}" class="form-control" name="inputBOL" id="inputBOL" readonly>
        </div>
      </div>
    @endif


    <button type="button" onclick="addItem()">Add New Item</button>
    <button type="submit" value="submit">Submit</button>

    <div class="well" id="itemList">

    </div>

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

    <div class="form-group">
      <label for="numItems" class="col-md-4 control-label">Num items</label>
      <div class="col-md-2">
        <input type="text" value="0" class="form-control" name="numItems" id="numItems" readonly>
      </div>
    </div>



  </form>
</div><!--col-->


  <div class="col-md-4">
    @include('partials.tyres')
  </div><!--col-->
</div><!--row-->
</div><!--panel-body-->
</div><!--panel-->
</div><!--col-->
</div><!--row-->
</div> <!--container-->
@endsection
