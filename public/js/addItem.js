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

    //Divs for every new invice item
    var subDiv = document.createElement("DIV");
    var subDivId = "subDiv" + count;
    subDiv.setAttribute("class", "tyreDiv");
    subDiv.setAttribute("id", subDivId);

    //Items that go inside the Divs
    var itemInput = document.createElement("INPUT");
    itemInput.setAttribute("type", "number");
    itemInput.setAttribute("min", "1");
    itemInput.setAttribute("class", "input");
    itemInput.setAttribute("name", itemId);
    itemInput.setAttribute("placeholder", "Tyre ID");
    itemInput.required = true;

    subDiv.appendChild(itemInput); //insert in the Div

    //Quantities for items
    var qtyInput = document.createElement("INPUT");
    qtyInput.setAttribute("type", "number");
    qtyInput.setAttribute("min", "0");
    qtyInput.setAttribute("class", "input");
    qtyInput.setAttribute("name", qty);
    qtyInput.setAttribute("placeholder", "Quantity");
    qtyInput.setAttribute("onchange", "updateTotals()");
    qtyInput.required = true;

    subDiv.appendChild(qtyInput); //insert in the Div

    //Unit prices for items
    var priceInput = document.createElement("INPUT");
    priceInput.setAttribute("type", "number");
    priceInput.setAttribute("min", "0");
    priceInput.setAttribute("step", "0.01");
    priceInput.setAttribute("class", "input");
    priceInput.setAttribute("name", price);
    priceInput.setAttribute("placeholder", "Unit Price");
    priceInput.setAttribute("onchange", "updateTotals()");
    priceInput.required = true;

    subDiv.appendChild(priceInput); //insert in the Div

    //Subtotal (quanity * unitPrice)
    var subTotalLabel = document.createElement("SPAN");
    subTotalLabel.setAttribute("name", "subTotal");
    subTotalLabel.setAttribute("id", "subTotal"+ count);


    subDiv.appendChild(subTotalLabel); //insert in the Div

    //Delete button - Replaces Remove Last Item Button
    var deleteButton = document.createElement("BUTTON");
    var func  = "remove(" + subDivId + ")";
    deleteButton.setAttribute("type", "button");
    deleteButton.setAttribute("onclick", func);
    deleteButton.innerHTML = "Delete";

    subDiv.appendChild(deleteButton);


    var itemlist = document.getElementById("itemList");
    itemlist.appendChild(subDiv);

    count++;
    document.getElementById("numItems").value = count;
  }

  /* Used to remove an item from the list
  *  Replaces old function removeItem
  *  Not because bugs, just better UX
  */
  function remove(subDivId)
  {
    var parent = document.getElementById("itemList");
    parent.removeChild(subDivId); // but why is the subDiv passed instead of id?
    count--;
    document.getElementById("numItems").value = count;
  }

  /* Used to remove last item
  *  We are going to replace this with remove() function
  *  to remove whichever div specified
  */
  function removeItem()
  {
    var parent = document.getElementById("itemList");
    var subDivId = "subDiv" + (count-1);
    var child = document.getElementById(subDivId);

    parent.removeChild(child);
    count--;
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
