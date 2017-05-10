@extends('layout')


@section('scripts')
  <script>
    // javascript included in layout file.
    var count=0;
    function addItem()
    {

      //names of parameters.
      var itemId = "tyre[" + count + "]";
      var qty = "qty[" + count + "]";
      var price = "price[" + count + "]";

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
      $("#"+subDivId).append("Tyre ID: ");
      subDiv.appendChild(itemInput); //insert in the Div

      var qtyInput = document.createElement("INPUT");
      qtyInput.setAttribute("type", "text");
      qtyInput.setAttribute("class", "input");
      qtyInput.setAttribute("name", qty);
      qtyInput.setAttribute("placeholder", "Quantity");

      $("#"+subDivId).append("Quantity: ");
      subDiv.appendChild(qtyInput); //insert in the Div
      //document.getElementById(subDivNum).appendChild(qtyInput);

      var priceInput = document.createElement("INPUT");
      priceInput.setAttribute("type", "text");
      priceInput.setAttribute("class", "input");
      priceInput.setAttribute("name", price);
      priceInput.setAttribute("placeholder", "Unit Price");

      $("#"+subDivId).append("Unit Price: ");
      subDiv.appendChild(priceInput); //insert in the Div
      //document.getElementById(subDivNum).appendChild(priceInput);

      var itemlist = document.getElementById("itemList");

      itemlist.appendChild(subDiv);

      count++;
      document.getElementById("numItems").value = count;
    }


  </script>
@endsection

@section('content')

<span>ENTER PERFORMA INVOICE ITEMS FOR LC</span><br><br>

<form method="post" action="/performa_invoices">

  {{ csrf_field() }}

  LC#<input type="text" name="inputLC"> <br>

  <button type="button" onclick="addItem()">Add New Item</button>
  <button type="submit" value="submit">Submit</button>

  <div id="itemList" style="border: 2px dashed black;">

  </div> <br>

  Num items <input type="text"  name="numItems" id="numItems" readonly>

</form>


@endsection
