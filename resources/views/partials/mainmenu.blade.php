{{--- mainmenu.blade.php
@author Ishtehar Hussain
@desc The main menu of the app in a partial file.
--}}

<div class="container-fluid">

  <!-- REPORTS -->

  <div class="row subMenu" id="theMenu">

    <div class="col-md-4"><a href="#">Order Report</a></div>
    <div class="col-md-4"><a href="#">Payment Report</a></div>
    <div class="col-md-4"><a href="#">Expenditure Report</a></div>
    <div class="col-md-4"><a href="#">Outstanding Balance Report</a></div>
    <div class="col-md-4"><a href="#">Profit/Loss Report</a></div>

  </div>

  <!-- VIEW INFO -->

  <div class="row subMenu" id="theMenu2">

    <div class="col-md-3">
      <a href="/customers">
        <h5>
          <span><img src="/images/user.png" width="45" height="45"></span>
          <strong>Customer</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/tyres">
        <h5>
          <span><img src="/images/tyre.png" width="32" height="32"></span>
          <strong>Tyre</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/consignments">
        <h5>
          <span><img src="/images/consignment.png" width="45" height="45"></span>
          <strong>Consignments</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/lcs">
        <h5>
          <span><img src="/images/lc.png" width="45" height="45"></span>
          <strong>LCs</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/consignment_expenses">
        <h5>
          <span><img src="/images/expense.png" width="45" height="45"></span>
          <strong>Expenses</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/orders">
        <h5>
          <span><img src="/images/order.png" width="40" height="40"></span>
          <strong>Order</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/payments">
        <h5>
          <span><img src="/images/cash.png" width="50" height="50"></span>
          <strong>Payment</strong>
        </h5>
      </a>
    </div>

    <div class="col-md-3">
      <a href="/stock">
        <h5>
          <span><img src="/images/stock.png" width="40" height="40"></span>
          <strong>Stock</strong>
        </h5>
      </a>
    </div>

    {{--<div class="col-md-4">
      <a href="/consignment_containers">
        consignment_containers
      </a>
    </div> --}}

  </div>

  <!-- ACTIONS -->

  <div class="row subMenu" id="theMenu3">

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
