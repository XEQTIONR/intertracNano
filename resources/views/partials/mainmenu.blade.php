{{--- mainmenu.blade.php
@author Ishtehar Hussain
@desc The main menu of the app in a partial file.
--}}

<div class="container-fluid">

  <!-- REPORTS -->

  <div class="row subMenu" id="theMenu" style="background-color: orange;">

    <div class="col-md-4"><a href="#">Order Report</a></div>
    <div class="col-md-4"><a href="#">Payment Report</a></div>
    <div class="col-md-4"><a href="#">Expenditure Report</a></div>
    <div class="col-md-4"><a href="#">Outstanding Balance Report</a></div>
    <div class="col-md-4"><a href="#">Profit/Loss Report</a></div>

  </div>

  <!-- VIEW INFO -->

  <div class="row subMenu" id="theMenu2" style="background-color: red;">

    <div class="col-md-4"><a href="/customers">Customer</a></div>
    <div class="col-md-4"><a href="/tyres">Tyre</a></div>
    <div class="col-md-4"><a href="/consignments">Consignments</a></div>
    <div class="col-md-4"><a href="/lcs">LCs</a></div>
    <div class="col-md-4"><a href="/consignment_expenses">Expenses</a></div>
    <div class="col-md-4"><a href="/orders">Order</a></div>
    <div class="col-md-4"><a href="/payments">Payment</a></div>
    <div class="col-md-4"><a href="/stock">Stock</a></div>

    <div class="col-md-4"><a href="/consignment_containers">consignment_containers</a></div>

  </div>

  <!-- ACTIONS -->

  <div class="row subMenu" id="theMenu3" style="background-color: green;">

    <div class="col-md-4"><a href="/tyres/create">Add a new Tyre</a></div>
    <div class="col-md-4"><a href="/lcs/create">Add new LC</a></div>
    <div class="col-md-4"><a href="/performa_invoices/create">Add new Performa Invoice</a></div>
    <div class="col-md-4"><a href="/consignments/create">Add new consignments</a></div>
    <div class="col-md-4"><a href="/consignment_expenses/create">Add new expense</a></div>

    <div class="col-md-4"><a href="/customers/create">Add a Customer</a></div>
    <div class="col-md-4"><a href="/orders/create">Create new Order</a></div>
    <div class="col-md-4"><a href="/payments/create">Create new Payment Invoice</a></div>

    <div class="col-md-4"><a href="/consignment_containers/create">Add containers to Consignment</a></div>
    <div class="col-md-4"><a href="/container_contents/create">New Commercial Invoice</a></div>
    <div class="col-md-4"><a href="/hscodes/create">Create a new Hscode</a></div>

  </div>

</div> <!--container fluid-->
