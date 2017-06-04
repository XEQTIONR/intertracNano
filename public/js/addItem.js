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

    var itemlist = document.getElementById("itemList");

    itemlist.appendChild(subDiv);

    count++;
    document.getElementById("numItems").value = count;
  }

  function removeItem()
  {
    //alert("remove item works");
    var parent = document.getElementById("itemList");

    var subDivId = "subDiv" + (count-1);
    //alert(subDivId);
    var child = document.getElementById(subDivId);
    //child.innerHTML = "<button>THE BUTTON</button>";

    parent.removeChild(child);
    count--;
    document.getElementById("numItems").value = count;

  }
