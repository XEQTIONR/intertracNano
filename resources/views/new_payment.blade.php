@extends('layouts.app')

@section('title')
  Payments
@endsection
@section('subtitle')
  Record a payment.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Payments',
    'subcrumb' => 'Record a payment',
     'link' => route('payments.create')])
  @endcomponent
@endsection

@section('modal')
  <div v-cloak class="modal modal-warning fade in" id="modal-warning">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-warning mr-2"></i> Confirm payment</h4>
        </div>
        <div class="modal-body">
          <p> Confirm payment of ৳<b>@{{ amount | currency }}</b>. You can print the receipt after confirming</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button @click="pay()" data-dismiss="modal" type="button" class="btn btn-outline">Confirm payment</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div v-cloak class="modal modal-danger fade in" id="modal-error">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title"> <i class="fa fa-times-circle mr-2"></i> Error</h4>
        </div>
        <div class="modal-body">
          <p>@{{ error_message }}</p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('header-scripts')

  <style>
    .progress-bar-colorful
    {
      -webkit-transition: background-color .6s ease, width .6s ease;
      -o-transition: background-color .6s ease, width .6s ease;
      transition: background-color .6s ease, width .6s ease;
    }
  </style>
@endsection

@section('body')


<transition v-cloak name="custom-classes-transition"
                  mode="out-in"
                  enter-active-class="animated fadeInRight"
                  leave-active-class="animated fadeOutLeft"
>
  <div v-if="!paid" key="0" class="row justify-content-center">
  <div class="col-xs-12">

    <div class="box box-maroon">
      <div class="box-header">
        <h3 class="page-header ml-3"><i class="icon-hand-holding-usd-s fa-hand-holding-usd mr-3"></i>Record payments for an order</h3>
      </div>
      <div class="box-body">
        <form>

          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="inputOrder">Order</label>
                  <v-select id="order" class="form-control" placeholder="Select an order" name="inputOrder"
                            v-model="order" :options="unpaidOrders" label="Order_num"
                  >
                  </v-select>
                </div>
              </div>
            </div>

            <div v-if="order" class="row">
              <div class="col-xs-12">
                <address>
                  <b>@{{ order.customer.name }}</b> <br>
                  <span v-html="order.customer.address"></span> <br>
                  @{{ order.customer.phone }}
                </address>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <table class="table table-striped" v-if="order">
                  <thead>
                    <tr>
                      <th class="col-xs-1">#</th>
                      <th class="col-xs-3">Tyre</th>
                      <th class="col-xs-2">Qty</th>
                      <th class="col-xs-2">Unit Price</th>
                      <th class="col-xs-2 text-right">Subtotal</th>
                      <th class="col-xs-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in order.order_contents">
                      <td class="col-xs-1">@{{ index+1 }}</td>
                      <td class="col-xs-3"><b>(@{{ item.tyre.tyre_id }})</b> @{{ item.tyre.brand }} @{{ item.tyre.size }} @{{ item.tyre.pattern }} @{{ item.tyre.lisi }}</td>
                      <td class="col-xs-2">@{{ item.qty }}</td>
                      <td class="col-xs-2">৳ @{{ item.unit_price }}</td>
                      <td class="col-xs-2 text-right">৳ @{{ parseFloat(item.unit_price)* parseInt(item.qty) | currency}}</td>
                      <td class="col-xs-2"></td>
                    </tr>
                    <tr>
                      <th class="col-xs-1"></th>
                      <th class="col-xs-3">Total</th>
                      <th class="col-xs-2"></th>
                      <th class="col-xs-2"></th>
                      <th class="col-xs-2 text-right">৳ @{{ subTotal | currency }}</th>
                      <th class="col-xs-2"></th>
                    </tr>
                    <tr>
                      <th></th>
                      <th>Discount</th>
                      <th></th>
                      <th></th>
                      <th class="text-right">৳ @{{ discountTotal | currency }}</th>
                      <th></th>
                    </tr>
                    <tr>
                      <th></th>
                      <th>Tax</th>
                      <th></th>
                      <th></th>
                      <th class="text-right">৳ @{{ taxTotal | currency }}</th>
                      <th></th>
                    </tr>
                    <tr>
                      <th></th>
                      <th class="text-uppercase">Grand Total</th>
                      <th></th>
                      <th></th>
                      <th class="text-right">৳ @{{ grandTotal | currency }}</th>
                      <th></th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div v-if="order" class="row">
              <div class="col-xs-12">
                <table class="table table-bordered  table-responsive">
                  <thead>
                    <tr>
                      <th class="col-xs-1">Transaction Id</th>
                      <th class="col-xs-3">Payment Date</th>
                      <th class="col-xs-2">Amount Paid</th>
                      <th class="col-xs-2"></th>
                      <th class="col-xs-2 text-right">Balance</th>
                      <th class="col-xs-2"></th>
                    </tr>
                  </thead>
                  <tbody v-if="order && order.payments">
                    <tr  v-for="(payment, index) in order.payments">
                      <td class="col-xs-1"> @{{ payment.transaction_id | transactionid_zerofill}}</td>
                      <td class="col-xs-3"> @{{ payment.created_at | ddmmyyyy }}</td>
                      <td class="col-xs-2">৳ @{{ parseFloat(payment.payment_amount) | currency }}</td>
                      <td class="col-xs-2"></td>
                      <td class="col-xs-2 text-right">৳ @{{ runningTotal(index) | currency }}</td>
                      <td class="col-xs-2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div v-if="order" class="row justify-content-center">
              <div class="progress col-xs-12 px-0 mx-4">
                <div class="progress-bar progress-bar-colorful" :style="{width: fractionTotalP+'%', backgroundColor: fractionColor}">@{{ (fractionTotalP < 100) ? (parseFloat(fractionTotalP).toFixed(2)) +' % Paid'   : 'Paid Off' }}</div>
              </div>
            </div>
            <div v-if="order" class="row justify-content-center">
              <div class="col-xs-12 col-md-4">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon"><b>৳</b></span>
                  <input v-model="amount" type="number" min="1" step="0.1" class="form-control">
                  <span class="input-group-btn">
                    <button @click="showModal()"  type="button" class="btn bg-maroon btn-flat" :disabled="!(parseFloat(amount)>0)">Pay</button>
                  </span>
                </div>
              </div>
            </div>
            <div v-if="amount>0" class="row justify-content-center">
              @{{ amountToWords }}  <span class="mx-1" v-html="toWordsPoisha"></span> Taka only
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
  <div v-else key="1" class="row justify-content-center">
  <div class="col-xs-12 col-md-8">
    <section  class="invoice" style="min-height: 95vh">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img class="d-block mx-auto" src="/images/crosscountry.png" height="75" width="auto">
{{--            <small class="pull-right">Date: @{{ payment_at | ddmmyyyy }}</small>--}}
          </h2>
          <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"><h2 class="text-center text-uppercase mb-4"><b>Receipt</b></h2></div>
            <div class="col-xs-4"><small class="pull-right"><strong>Date :</strong> @{{ payment_at | ddmmyyyy }}</small></div>
          </div>
{{--          <h2 class="text-center text-uppercase mb-4"><b>Receipt</b></h2>--}}
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Payment By
          <address>
            <strong v-text="order.customer.name"></strong><br>
            <span v-html="order.customer.address"></span><br>
            <span v-text="order.customer.phone"></span>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Paid To
          <address>
            <strong>Cross Country</strong><br>
            7/5 Ring Road Shyamoli,<br>
            Dhaka 1207
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Transaction ID : @{{ transaction_id | transactionid_zerofill}}</b><br>
          <b>Order #</b> @{{ order.Order_num }}<br>
          <b>Account :</b> @{{ order.customer.id }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row justify-content-center">
        <div class="col-xs-3">
          <h4>Amount Paid</h4>
        </div>
        <div class="col-xs-7" style="border-bottom : 2px solid black">
          <h3 class="text-center">৳ @{{ amount | currency }}</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h3 class="text-center text-capitalize"> @{{ amountToWords }} <span class="mx-2" v-html="toWordsPoisha"></span> taka only</h3>
        </div>
      </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Order Total</th>
              <th></th>
              <th>৳ <span style="float :right">@{{ grandTotal | currency }}</span></th>
              <td></td>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th>Previous Payments Total</th>
              <td><i class="fa fa-minus"></i></td>
              <td>৳ <span style="float :right">@{{ paymentsTotal() - amount | currency }}</span></td>
              <td></td>
            </tr>
            <tr>
              <th>Current Payment</th>
              <td><i class="fa fa-minus"></i></td>
              <td>৳ <span style="float :right">@{{ amount | currency }}</span></td>
              <td></td>
            </tr>
            <tr style="border-top : 2px solid black">
              <th>Balance</th>
              <td></td>
              <td>৳ <span style="float :right">@{{ grandTotal - paymentsTotal() | currency }}</span></td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <small class="text-center text-uppercase d-block mx-auto">Thanks and regards</small>
        </div>
      </div>

      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="no-print row mx-auto" style="position: absolute; bottom: 10; left: 0; width: 100%">
        <div class="col-xs-12">
          <button onclick="window.print()" class="btn bg-navy pull-right"><i class="fa fa-print"></i> Print</button>
          <a href="{{ route('payments.create') }}" type="button" class="btn btn-default">
            <i class="fa fa-chevron-left"></i> Another Payment
          </a>
          {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
            {{--<i class="fa fa-download"></i> Generate PDF--}}
          {{--</button>--}}
        </div>
      </div>

      <div class="print-footer">
{{--        <div class="col-xs-12">--}}
          <div class="col-xs-5">
            <div class="row" style="border-top: 1px solid rgb(187, 187, 187);">
              <h4 class="mx-auto">Received By</h4>
            </div>
          </div>
          <div class="col-xs-1"></div>
          <div class="col-xs-1"></div>
          <div class="col-xs-5">
            <div class="row" style="border-top: 1px solid rgb(187, 187, 187);">
              <h4 class="mx-auto">For Cross Country</h4>
            </div>
          </div>
{{--        </div>--}}

      </div>
    </section>
  </div>
</div>

</transition>

@endsection



@section('footer-scripts')
  <script>

    var orders = JSON.parse('{!! str_replace("'", "\'", $orders) !!}');

    var app = new Vue({
        el: '#app',
        data: {
            orders : Object.values(orders), // object to array
            order : null,
            amount : 0,
            numberToWords : numberToWords,
            paid : false,
            transaction_id : null,
            payment_at : null,
            error_message : null,
            random_string : Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15)
        },

        watch:{

            amount : function(new_val){

                if(parseFloat(new_val)> this.grandTotal - this.paymentsTotal())
                  this.amount = this.grandTotal- this.paymentsTotal();
                else
                  this.helperPositiveFloat(new_val, "amount");
            },
        },

        computed : {

            toWordsPoisha : function(){

                var amount;

                if((typeof this.amount) == "number")
                    amount = this.amount.toString();
                else
                    amount = this.amount;

                if(amount.indexOf('.') == -1)
                    return "";
                else if(parseFloat(amount.split('.')[1])==0)
                    return "";

                var poisha = amount.split('.')[1];

                if(poisha.length == 1)
                    poisha = poisha + '0';
                if(poisha.length>2)
                    poisha = poisha.substr(0, 2);//+'.'+poisha.substr(2, poisha.length);

                return ' '+poisha + '&frasl;100';

            },

            unpaidOrders : function(){

                var unpaid = [];
                // console.log(this.orders);
                // console.log(this.orders.length);

                this.orders.forEach(function (value, index) {

                    var paymentsTotal = 0;
                    var subTotal = 0;

                    value.payments.forEach(function(value){

                        paymentsTotal+= parseFloat(value.payment_amount);
                    });

                    value.order_contents.forEach(function(value){

                        subTotal+= parseInt(value.qty)*parseFloat(value.unit_price);
                    });

                    var discountTotal = (subTotal * parseFloat(value.discount_percent)/100.0) + parseFloat(value.discount_amount);
                    var taxTotal = (subTotal * parseFloat(value.tax_percentage)/100.0) + parseFloat(value.tax_amount);

                    var grandTotal = subTotal - discountTotal + taxTotal;

                    console.log('index : ' + index);
                    console.log('grandTotal: ' + grandTotal);
                    console.log('paymentsTotal: ' + paymentsTotal);


                    if(grandTotal > paymentsTotal)
                        unpaid.push(value);
                });

                return unpaid;
            },

            subTotal : function(){

                var ret = 0;

                if(app.order)
                    app.order.order_contents.forEach(function(value){
                        ret+= parseFloat(value.unit_price)* parseInt(value.qty);
                    });

                return ret;

            },

            discountTotal : function() {

                var discount_percentage_amount = 0;
                var discount_amount_amount = 0;

                if(app.order)
                {
                    discount_percentage_amount = app.subTotal * parseFloat(app.order.discount_percent)/100.0;
                    discount_amount_amount = parseFloat(app.order.discount_amount);
                }

                return (discount_percentage_amount + discount_amount_amount);
            },

            taxTotal : function() {

                var tax_percentage_amount = 0;
                var tax_amount_amount = 0;

                if(app.order)
                {
                    tax_percentage_amount = app.subTotal * parseFloat(app.order.tax_percentage)/100.0;
                    tax_amount_amount = parseFloat(app.order.tax_amount);
                }

                return (tax_percentage_amount + tax_amount_amount);
            },

            grandTotal : function(){
                return this.subTotal - this.discountTotal + this.taxTotal
            },

            amountToWords : function(){

                return this.numberToWords.toWords(parseFloat(this.amount));
            },

            fractionTotalP : function(){

                //return this.paymentsTotal();
                return ((this.paymentsTotal()+parseFloat(this.amount))/this.grandTotal)*100;// * 100;
            },

            fractionColor : function(){

                // var green = 255 * (this.fractionTotalP/100);
                // var red = 255 * ((100-this.fractionTotalP)/100);
                // return "rgba(" + red + "," + green + ", 0 ,1)";

                //0-120

                var val = Math.floor(120*(this.fractionTotalP/100));

                return "hsl(" + val + ",60%,50%)";

                //hsl(90,50%,50%)
            }


        },

        methods : {

            // for each payment alread
            runningTotal : function(index){

                var total =  this.grandTotal;

                for(var i=0; i<=index; i++)
                {
                    total -= parseFloat(this.order.payments[i].payment_amount);
                }

                return total;
            },

            showModal : function(){
                $('#modal-warning').modal('show');
            },

            paymentsTotal : function(){

                // index-th order
                var total = 0;

                if(this.order)
                    this.order.payments.forEach(function(value){

                        total+= parseFloat(value.payment_amount);
                    });
                return total;
            },

            pay : function(){

                $.post("{{ route('payments.store')  }}",
                    {
                        "_token" : "{{csrf_token()}}",
                        amount : parseFloat(app.amount),
                        order : app.order.Order_num,
                        random : app.random_string
                    },

                    function(data)
                    {
                        if(data.status ==  'success')
                        {
                            app.order.payments.push(data.payment);
                            app.paid = true;
                            app.transaction_id = data.payment.transaction_id;
                            app.payment_at = data.payment.created_at;
                            //app.amount = 0;
                        }
                        else{
                            if(data.status == 'failed' && data.message)
                            {
                                app.error_message = data.message;
                                $('#modal-error').modal('show');
                                //console.log(data.message);
                            }
                        }

                    });
            },
            //HELPERs
            helperPositiveFloat : function(new_val, who){
                if(!(parseFloat(new_val)>= 0 ) )
                {
                    app[who] = 0;
                }

                var leading = 0;
                var lead_mid = false;
                var decimal_count = 0;
                var lead_or_trail = "lead";

                for(var i=0; i<new_val.length; new_val++)
                {
                    if(new_val[i] == '0')
                    {
                        if(lead_or_trail == "lead" && !lead_mid)
                            leading++;
                    }
                    else if(new_val[i] == '.')
                    {
                        decimal_count++;
                        lead_or_trail = "trail";
                    }
                    else{
                        if(lead_or_trail == "lead")
                            lead_mid = true;
                    }
                }

                if(decimal_count>1)
                    app[who] = 0;
                else if(leading>0)
                    app[who] = app[who].substr(leading);


            }
        },

        mounted: function(){
            $('.modal').modal();
            $('.modal').modal('hide');
        }
    })
  </script>
@endsection
