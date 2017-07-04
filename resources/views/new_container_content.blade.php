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
    width : 20%;
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
    itemInput.setAttribute("type", "text");
    itemInput.setAttribute("class", "input");
    itemInput.setAttribute("name", itemId);
    itemInput.setAttribute("placeholder", "Tyre ID");

    //document.getElementById(subDivNum).appendChild(itemInput);
    //$("#"+subDivId).append("Tyre ID: ");
    subDiv.appendChild(itemInput); //insert in the Div

    var qtyInput = document.createElement("INPUT");
    qtyInput.setAttribute("type", "text");
    qtyInput.setAttribute("class", "input");
    qtyInput.setAttribute("name", qty);
    qtyInput.setAttribute("placeholder", "Quantity");

    //$("#"+subDivId).append("Quantity: ");
    subDiv.appendChild(qtyInput); //insert in the Div
    //document.getElementById(subDivNum).appendChild(qtyInput);

    var priceInput = document.createElement("INPUT");
    priceInput.setAttribute("type", "text");
    priceInput.setAttribute("class", "input");
    priceInput.setAttribute("name", price);
    priceInput.setAttribute("placeholder", "Unit Price");

    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(priceInput); //insert in the Div
    //document.getElementById(subDivNum).appendChild(priceInput);

    var weightInput = document.createElement("INPUT");
    weightInput.setAttribute("type", "text");
    weightInput.setAttribute("class", "input");
    weightInput.setAttribute("name", weight);
    weightInput.setAttribute("placeholder", "Total Weight");

    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(weightInput); //insert in the Div

    var taxInput = document.createElement("INPUT");
    taxInput.setAttribute("type", "text");
    taxInput.setAttribute("class", "input");
    taxInput.setAttribute("name", tax);
    taxInput.setAttribute("placeholder", "Total Tax");

    //$("#"+subDivId).append("Unit Price: ");
    subDiv.appendChild(taxInput); //insert in the Div



    var itemlist = document.getElementById("itemList");

    itemlist.appendChild(subDiv);

    count++;
    document.getElementById("numItems").value = count;
  }

  </script>
@endsection


@section('content')

<div class="container">

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

    </div> <br>

    <div class="form-group">
      <label for="numItems" class="col-md-4 control-label">Num items</label>
      <div class="col-md-2">
        <input type="text" value="0" class="form-control" name="numItems" id="numItems" readonly>
      </div>
    </div>



  </form>
</div><!--col-->


  <div class="col-md-4">
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
  </div><!--col-->
</div><!--row-->
</div><!--panel-body-->
</div> <!--container-->
@endsection
