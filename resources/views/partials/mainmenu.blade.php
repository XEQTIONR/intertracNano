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

    <div class="col-md-3 vertical-spaced">
      <a href="/customers">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/user.png" width="45" height="45">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Customers
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
              View all customer information.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/tyres">
        <div class="row">
          <div class="col-md-2" >
            <img src="/images/tyre.png" width="35 " height="35">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Tyres
              </div>
            </div> <!--row-->

            <div class="row">
              <div class="col-md-12">
                View the tyre Catalog
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/consignments">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/consignment.png" width="45" height="45">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Consignments
              </div>
            </div>
              <div class="row">
                <div class="col-md-12">
                View all consignments arrived
                </div>
              </div>
            </div>
          </div> <!--row-->
        </a>
      </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/lcs">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/lc.png" width="45" height="45">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                LCs
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                View all information about LCs applied for.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/consignment_expenses">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/expense.png" width="40" height="40">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Expenses
              </div>
            </div> <!--row-->

            <div class="row">
              <div class="col-md-12">
                View all consignment expenses.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/orders">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/order.png" width="40" height="40">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Orders
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
              View all orders placed.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div>

    <div class="col-md-3 vertical-spaced">
      <a href="/payments">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/cash.png" width="48" height="48">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Payments
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                View all payments recieved from customers.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div>


    <div class="col-md-3 vertical-spaced">
      <a href="/stock">
        <div class="row">
          <div class="col-md-2">
            <img src="/images/stock.png" width="40" height="40">
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 menu-option-title">
                Stock
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                View all customer information.
              </div>
            </div>
          </div>
        </div> <!--row-->
      </a>
    </div><!--col-->


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
