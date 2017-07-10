/**   addItem.js
* @author Ishtehar Hussain
* @desc The script that dynamically adds are removes fields about tyres
* in different forms.
*/

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
    qtyInput.required = true;
    //$("#"+subDivId).append("Quantity: ");
    subDiv.appendChild(qtyInput); //insert in the Div
    //document.getElementById(subDivNum).appendChild(qtyInput);

    var priceInput = document.createElement("INPUT");
    priceInput.setAttribute("type", "number");
    priceInput.setAttribute("min", "0");
    priceInput.setAttribute("class", "input");
    priceInput.setAttribute("name", price);
    priceInput.setAttribute("placeholder", "Unit Price");
    priceInput.required = true;
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
