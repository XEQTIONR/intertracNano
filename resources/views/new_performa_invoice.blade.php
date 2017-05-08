@extends('layout')


@section('scripts')
  <script>
    // javascript included in layout file.
    var count=0;
    function addItem()
    {

      var itemId = "tyre" + count;
      var qty = "qty" + count;
      var price = "price" + count;

      var subDiv = document.createElement("DIV");
      var subDivId = "subDiv" + count;

      subDiv.setAttribute("class", "tyreDiv");
      subDiv.setAttribute("id", subDivId);

      //document.getElementById("itemList").append(subDiv);

      var itemInput = document.createElement("INPUT");
      itemInput.setAttribute("type", "text");
      itemInput.setAttribute("class", "input");
      itemInput.setAttribute("name", itemId);

      //document.getElementById(subDivNum).appendChild(itemInput);
      $("#"+subDivId).append("Tyre ID: ");
      subDiv.appendChild(itemInput);

      var qtyInput = document.createElement("INPUT");
      qtyInput.setAttribute("type", "text");
      qtyInput.setAttribute("class", "input");
      qtyInput.setAttribute("name", qty);

      $("#"+subDivId).append("Quantity: ");
      subDiv.appendChild(qtyInput);
      //document.getElementById(subDivNum).appendChild(qtyInput);

      var priceInput = document.createElement("INPUT");
      priceInput.setAttribute("type", "text");
      priceInput.setAttribute("class", "input");
      priceInput.setAttribute("name", price);

      $("#"+subDivId).append("Unit Price: ");
      subDiv.appendChild(priceInput);
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

  Num items <input type="text"  name="numItems "id="numItems" readonly>

</form>


@endsection
