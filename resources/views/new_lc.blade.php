@extends('layouts.app')

@section('title')
  Letters of credit
@endsection
@section('subtitle')
  Add a new LC.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Letters of Credit',
    'subcrumb' => 'All LCs',
     'link' => route('lcs.index')])
  @endcomponent
@endsection

@section('body')

    <div class="row justify-content-center">
      <transition  name="custom-classes-transition"
                  mode="out-in"
                  {{--enter-class = "mimi"--}}
                   :enter-active-class="direction? 'animated fadeInRight fast' : 'animated fadeInLeft fast'"
                   :leave-active-class="direction? 'animated fadeOutLeft fast' : 'animated fadeOutRight fast'"
                   {{--enter-active-class="animated fadeInRight fast"--}}
                   {{--leave-active-class="animated fadeOutLeft fast"--}}
      >
        <div  v-if="showForm == 0" key="0" class="col-xs-12 col-md-6">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="page-header ml-3"><i class="fas fa-file-invoice-dollar mr-3"></i> Enter LC Information</h3>
            </div>
            <div class="box-body">

              <form>
                <div class="box-body">

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>LC#</label>
                      <div class="input-group">
                        <span class="input-group-addon">F20</span>
                        <input id="lcNum" v-model="lc_num" type="text" class="form-control" placeholder="Enter letter of credit number">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Date Issued</label>
                      <div class="input-group">
                        <span class="input-group-addon">F31C</span>
                        <input v-model="date1"  @click="datetify()" @blur="copyDate(1)" id="dateIssued" type="text" class="form-control date">
                        <div class="input-group-addon">
                          <i class="fas fa-calendar-alt"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Date Expiry</label>
                      <div class="input-group">
                        <span class="input-group-addon">F31D</span>
                        <input v-model="date2" @click="datetify()" @blur="copyDate(2)" id="dateExpiry" type="text" class="form-control date">
                        <div class="input-group-addon">
                          <i class="fas fa-calendar-alt"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Applicant</label>
                      <div class="input-group">
                        <span class="input-group-addon">F31D</span>
                        <textarea id="applicant" v-model="applicant" class="form-control" rows="3" placeholder="Enter applicant name and address"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Beneficiary</label>
                      <div class="input-group">
                        <span class="input-group-addon">F50</span>
                        <textarea id="beneficiary"  v-model="beneficiary" class="form-control" rows="3" placeholder="Beneficiary name and address"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Departing Port</label>
                      <div class="input-group">
                        <span class="input-group-addon">F44E</span>
                        <input v-model="departing_port" type="text" class="form-control" placeholder="Enter departing port">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Arriving Port</label>
                      <div class="input-group">
                        <span class="input-group-addon">F44F</span>
                        <input v-model="arriving_port" type="text" class="form-control" placeholder="Enter departing port">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Foreign currency code</label>
                      <div class="input-group">
                        <span class="input-group-addon">F32B</span>
                        <input v-model="currency_code" type="text" class="form-control" placeholder="Currency Code">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-8">
                    <div class="form-group">
                      <label>LC Value (in foreign currency)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>@{{currency_symbol}}</strong></span>
                        <input v-model="lc_value" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Exchange Rate</label>
                      <div class="input-group">

                        <input v-model="exchange_rate" type="number" step="0.01" class="form-control" placeholder="0.00">
                        <span class="input-group-addon"><strong>/ @{{currency_symbol}}</strong></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-8">
                    <div class="form-group">
                      <label>LC Value (in local currency) </label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" :value="lc_local_value | currency" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Expenses Paid (Foreign)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>@{{currency_symbol}}</strong></span>
                        <input v-model="expense_foreign" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Expenses Paid (Local)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input v-model="expense_local" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Notes</label>
                      {{--<div class="input-group">--}}
                      {{--<span class="input-group-addon">F50</span>--}}
                      <textarea v-model="notes" id="notes" class="form-control" rows="3" placeholder="Any additonal information you want to record about this LC"></textarea>
                      {{--</div>--}}

                    </div>
                    <div class="col-12">
                      <button type="button" class="btn btn-info pull-right" @click="toggle(true)">
                        Continue
                        <i class="fa fa-chevron-right pt-1 ml-2"></i>
                      </button>
                    </div>
                  </div>



                  <!-- /.input group -->

                  {{--<label for="LcNumber" class="col-md-3 col-md-offset-2 control-label">LC#  <small>F20</small></label>--}}
                  {{--<div class="col-md-3">--}}
                  {{--<input type="text" class="form-control" name="LcNumber" id="inputLCnum" value="{{old('LcNumber')}}" required>--}}
                  {{--</div>--}}
                </div>
              </form>


            </div>
          </div>
        </div>
        {{--</transition>--}}
        {{--<transition name="custom-classes-transition" enter-active-class="animated zoomin" leave-active-class="animated fadeOutRight">--}}
        <div  v-if="showForm == 1" key="1"  class="col-xs-7">
          {{--<div class="col-xs-7">--}}
            {{--<div class="box">--}}
              {{--<button @click="add()">Click Me!</button>--}}
              {{--<transition-group name="list" tag="div">--}}
                {{--<span v-for="item in jaitems" class="list-item" :key="item.id">--}}
                  {{--@{{ item.name }}--}}
                {{--</span>--}}
              {{--</transition-group>--}}
            {{--</div>--}}
            <div class="box box-info">
              <div class="box-header">
                <h3 class="page-header ml-3"><i class="far fa-receipt mr-3"></i> Enter Proforma Invoice</h3>
              </div>
              <div class="box-body p-5">

                <form style="padding: 1rem;">
                  <div class="row pb-1">
                    <div class="col-xs-1 text-center"><strong>#</strong></div>
                    <div class="col-xs-4 text-center"><strong>Tyre</strong></div>
                    <div class="col-xs-2 text-center"><strong>Qty</strong></div>
                    <div  class="col-xs-2 text-right"><strong>Unit Price</strong></div>
                    <div  class="col-xs-2 text-right"><strong>Sub Total</strong></div>
                    <div class="col-xs-1"></div>
                  </div>
                  {{--<ol class="table ">--}}


                    {{--<tbody>--}}
                    <transition-group  name="custom-classes-transition"
                                       {{--tag="ol"--}}
                                       {{--mode="out-in"--}}
                                 {{--enter-class = "mimi"--}}
                                 enter-active-class="animated fadeInDown"
                                 {{--enter-class="animated tada"--}}
                                 leave-active-class="animated fadeOutUp fast "
                    >
                    <div v-if="!proforma_invoice.length" key="default" class="row list-item justify-content-center my-4">
                      <span class="text-center "> Nothing in the proforma invoice yet</span>
                    </div>
                    <div class="row list-item pt-4" :class="{'bg-light-gray' : !(index%2)}" v-for="(item,index) in proforma_invoice" :key="item.tyre_id" >
                      {{--<div class="row">--}}
                      <div class="col-xs-1 text-center">
                        @{{ index+1 }}
                      </div>
                      <div class="col-xs-4">
                        @{{item.brand}} @{{item.size}} @{{ item.lisi }} @{{item.pattern}}
                      </div>
                      <div class="col-xs-2 form-group" :class="{'has-error' : item.qty==0}">
                        <input class="text-right form-control" v-model="item.qty" type="number" step="1" min="1" value="1">
                      </div>
                      <div class="col-xs-2 form-group"  :class="{'has-error' : item.unit_price==0}">
                        <input class="text-right form-control" v-model="item.unit_price" type="number" step="0.01" min="0.01" value="0.01">
                      </div>
                      <div class="col-xs-2 text-right">
                        @{{ currency_symbol }} @{{ subTotal(index) | currency}}
                      </div>
                      <div class="col-xs-1">
                        <a class="text-danger" @click="removeTyre(index)">
                          <i class="fas fa-minus-circle mt-1"></i>
                        </a>
                      </div>
                      {{--</div>--}}
                    </div>
                    </transition-group>
                    <div class="row list-item pt-2 border-light-gray" style="border-top: 1px solid">
                      <div class="col-xs-8 col-sm-3 col-sm-offset-5">
                        <strong class="font-light-gray">Grand Total</strong>
                      </div>
                      <div class="col-xs-4 text-right mr-invoice">
                        <strong>@{{ currency_symbol }} @{{grand_total | currency}}/-</strong>
                      </div>
                    </div>

                    <div class="row list-item mt-2 pt-2">
                      <div class="col-xs-8 col-sm-3 col-sm-offset-5">
                        <strong>Grand Total <br>(in Taka)</strong>
                      </div>
                      <div class="col-xs-4 text-right mr-invoice">
                       ৳ @{{(grand_total* exchange_rate) | currency}}/-
                      </div>
                    </div>
                    <div class="row list-item mt-2 pt-2">
                      <div class="col-xs-8 col-sm-3 col-sm-offset-5">
                        <strong>Total Qty</strong>
                      </div>
                      <div class="col-xs-4 text-right mr-invoice pr-1">
                        @{{ total_qty }}
                      </div>
                    </div>


                    {{--</tbody>--}}
                  {{--</ol>--}}
                </form>
                <button type="button" class="btn btn-default" @click="toggle(false)">
                  <i class="fa fa-chevron-left pt-1 mr-2"></i>
                  Back
                </button>
                <button type="button" class="btn btn-info pull-right" @click="toggle(true)">
                  Continue
                  <i class="fa fa-chevron-right pt-1 ml-2"></i>
                </button>
              </div>
            </div>


        </div>

        <div v-if="showForm == 2" key="2" class="col-xs-12">
          <section class="invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fas fa-check mr-3 text-success"></i>Confirm new LC information
                  <small class="pull-right">Date: 2/10/2014</small>
                </h2>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>LC # @{{ lc_num }}</b><br>
                <b>Date Issued:</b> @{{ date_issued }}<br>
                <b>Date Expiry:</b> @{{ date_expired }}<br>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Applicant</b>
                <address v-html="applicant">
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Beneficiary</b>
                <address v-html="beneficiary">
                </address>
              </div>

            </div>
            <div class="row invoice-info mt-3">
              <div class="col-sm-4 invoice-col">
                <b>Foreign Currency Code:</b> @{{ currency_code }}<br>
                <b>Exchange Rate:</b> @{{ exchange_rate | currency }} / @{{ currency_symbol }}<br>
                <br>
                <b>Departing Port:</b> @{{ departing_port }}<br>
                <b>Arriving Port:</b> @{{ arriving_port }}<br>

              </div>

              <div class="col-sm-4 invoice-col">
                <b>Expenses Foreign:</b> @{{ currency_symbol }} @{{ expense_foreign | currency }}<br>
                <b>Expenses Local:</b> @{{ expense_local }}<br>
              </div>

              <div class="col-sm-4 invoice-col">
                <b>LC Value :</b>@{{ currency_symbol }} @{{ lc_value | currency }}<br>
                <b>LC Value in TK:</b> @{{ currency_symbol }} @{{ lc_value*exchange_rate | currency }}<br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Tyre</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(record, index) in proforma_invoice">
                    <td>@{{ index+1 }}</td>
                    <td>@{{ record.brand }} @{{ record.size }} @{{ record.lisi }} @{{ record.pattern }}</td>
                    <td>@{{ record.qty }}</td>
                    <td>@{{ record.unit_price }}</td>
                    <td>@{{ currency_symbol }} @{{ record.qty*record.unit_price | currency }}</td>
                  </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              {{--<div class="col-xs-6">--}}
                {{--<p class="lead">Payment Methods:</p>--}}
                {{--<img src="../../dist/img/credit/visa.png" alt="Visa">--}}
                {{--<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
                {{--<img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
                {{--<img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

                {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
                  {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg--}}
                  {{--dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                {{--</p>--}}
              {{--</div>--}}
              <!-- /.col -->
              <div class="col-xs-6 col-xs-offset-6">
                {{--<p class="lead">Amount Due 2/22/2014</p>--}}

                <div class="table-responsive">
                  <table class="table">
                    <tbody><tr>
                      <th style="width:50%">Grand Total</th>
                      <td>@{{ currency_symbol }} @{{ grand_total | currency }}</td>
                    </tr>
                    <tr>
                      <th>Grand Total in TK</th>
                      <td>@{{ grand_total*exchange_rate | currency }}</td>
                    </tr>
                    <tr>
                      <th>Expenses Foreign</th>
                      <td>@{{ currency_symbol }} @{{ expense_foreign }}</td>
                    </tr>
                    <tr>
                      <th>Expense Local:</th>
                      <td>TK @{{ expense_local }}</td>
                    </tr>
                    </tbody></table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-xs-12">
                <button type="button" class="btn btn-default" @click="toggle(false)">
                  <i class="fa fa-chevron-left pt-1 mr-2"></i>
                  Back
                </button>
                <button type="button" class="btn btn-success pull-right" @click="toggle(true)">
                  <i class="fas fa-check mr-2"></i>
                  Confirm
                </button>
                {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
                {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
                {{--</button>--}}
                {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                  {{--<i class="fa fa-download"></i> Generate PDF--}}
                {{--</button>--}}
              </div>
            </div>
          </section>


        </div>




      </transition>
      <transition name="custom-classes-transition"
                  :enter-active-class="direction? 'animated fadeInRight delay-1s fast' : 'animated fadeInLeft delay-1s fast'"
                  :leave-active-class="direction? 'animated fadeOutLeft fast' : 'animated fadeOutRight fast'" >
        <div v-show="showForm == 1" class="col-xs-5">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tyre Catalog</h3>
            </div>
            {{--<div v-if="showCatalog == false" class="box-body">--}}
            {{--<button @click="tyreCatalog()" class="btn btn-primary">The button</button>--}}
            {{--</div>--}}
            <div class="box-body">
              {{--<keep-alive>--}}
              {{--<tyre-catalog></tyre-catalog>--}}
              {{--</keep-alive>--}}
              <table id ="table_id" class="table table-hover table-bordered">
                <thead>
                <tr>
                  <th>Tyre ID</th>
                  <th>Brand</th>
                  <th>Size</th>
                  <th>Li/Si</th>
                  <th>Pattern</th>
                  <th></th>

                </tr>
                </thead>
                <tbody>
                @if(isset($tyres) && count($tyres))
                  @foreach ($tyres as $tyre)
                    <tr>
                      <td>{{$tyre->tyre_id}}</td>
                      <td>{{$tyre->brand}}</td>
                      <td>{{$tyre->size}}</td>
                      <td>{{$tyre->lisi}}</td>
                      <td>{{$tyre->pattern}}</td>
                      <td>
                        <a class="text-success" @click="addTyre({{$tyre->tyre_id}})">
                          <i class="fas fa-plus-circle"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <td class="text-center" colspan="5"> <strong>There are currently no tyres in stock</strong></td>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </transition>

    {{--</div>--}}

  </div>

    {{--<button type="button" class="btn btn-primary pull-right" @click="toggle(true)">Toggle</button>--}}
@endsection

@section('footer-scripts')

  <script>

   var tyre_catalog = JSON.parse('{!! json_encode($tyres) !!}');


   Vue.filter('currency', function (value) {
          return parseFloat(value).toFixed(2);
      });

    var app = new Vue({
        el: '#app',
        data: {
            showForm : 0,
            showCatalog : false,
            tyre_catalog : tyre_catalog,

            lc_num : null,
            date_issued : null,
            date_expired : null,
            applicant : null,
            beneficiary : null,
            departing_port : null,
            arriving_port : null,
            currency_code : null,
            exchange_rate : null,
            lc_value : null,
            expense_foreign : null,
            expense_local : null,
            notes : null,

            proforma_invoice : [],

            direction : true,

            date_flag: false,
            date1: null,
            date2: null,
            currency_symbol: '$'

        },
        computed:{



            lc_local_value : function()
            {
                var ret_val = 0;
                if(!isNaN(this.lc_value)  && !isNaN(this.exchange_rate))
                    ret_val = this.lc_value * this.exchange_rate;
                return ret_val;
            },

            grand_total : function(){

                var ret_val = 0;
                if(this.proforma_invoice.length)
                {

                    this.proforma_invoice.forEach(function(value, index){

                        if(
                        typeof (value.qty) !== 'undefined' &&
                        typeof (value.unit_price) !== 'undefined' &&
                        value.qty.length &&
                        value.unit_price.length
                        )
                            ret_val += parseInt(value.qty) * parseFloat(value.unit_price)

                    });


                }
                return ret_val;
            },

            total_qty : function(){

                var ret_val = 0;

                this.proforma_invoice.forEach(function(value){
                   ret_val += parseInt(value.qty);
                });

                return ret_val;

            }
        },
        watch : {
            currency_code : function(new_val, old_val)
            {
                console.log("new_val upper :" + new_val.toUpperCase());
                if (typeof currencies[new_val] !== 'undefined')
                    this.currency_symbol = currencies[new_val.toUpperCase()];
                else
                    this.currency_symbol = '$';

                 if(new_val.toUpperCase() != new_val)
                     this.currency_code = new_val.toUpperCase();
            },

            date_issued : function(new_val){
                this.date1 = new_val;
            },
            date_expired : function(new_val){
                this.date2 = new_val;
            }
        },

        methods: {

            datetify : function(){
              if(this.date_flag)
              {
                  this.date_flag = false;
                  $('.date').inputmask('dd/mm/yyyy');
              }
            },

            copyDate : function(i){

                if(i==1)
                    this.date_issued = document.getElementById('dateIssued').value;
                if(i==2)
                    this.date_expired = document.getElementById('dateExpiry').value;

            },

            copyDates : function(){
                this.copyDate(1);
                this.copyDate(2);
            },

            validate : function(){
                return true;
            },

            submit : function(){

                if(this.validate)
                    this.toggle(true);
            },

            subTotal : function(i){

                if(this.proforma_invoice.length>i &&
                    this.proforma_invoice.length>0 &&
                    typeof (this.proforma_invoice[i].qty) !== 'undefined' &&
                    typeof (this.proforma_invoice[i].unit_price) !== 'undefined' &&
                    this.proforma_invoice[i].qty.length &&
                    this.proforma_invoice[i].unit_price.length
                )
                    return parseInt(this.proforma_invoice[i].qty) * parseFloat(this.proforma_invoice[i].unit_price);
                return 0;
            },


            toggle : function(direction){
                if(this.showForm==0)
                {
                    this.date_flag = false;
                    this.copyDates();

                    this.applicant = $("#applicant").val().replace(/(\r\n|\n)/g, "<br/>");
                    this.beneficiary = $("#beneficiary").val().replace(/(\r\n|\n)/g, "<br/>");
                    this.notes = $("#notes").val().replace(/(\r\n|\n)/g, "<br/>");


                }
                else
                {
                    this.date_flag = true;

                    this.date1 = this.date_issued;
                    this.date2 = this.date_expired;
                    // if(this.date_issued && this.date_expired
                    //     && document.getElementById('dateIssued') && document.getElementById('dateExpiry'))
                    // {
                    //     document.getElementById('dateIssued').value  =  this.date_issued;
                    //     document.getElementById('dateExpiry').value  =  this.date_expired;
                    // }

                }


                this.direction = direction;

                if(direction)
                    (this.showForm  == 2) ? this.showForm = 0 : this.showForm++;
                else
                    (this.showForm  == 0) ? this.showForm = 2 : this.showForm--;

                // if(this.showForm == 0)
                // {
                //     this.$nextTick(function() {
                // //
                //
                //           if(document.getElementById('dateIssued') && document.getElementById('dateExpiry'))
                //         {
                //             $(".date").inputmask("dd/mm/yyyy");
                //             console.log('set value value');
                //             document.getElementById('dateIssued').value  =  app.date_issued;
                //             document.getElementById('dateExpiry').value  =  app.date_expired;
                //         }
                // //
                //     });
                // //
                // }

            },

            tyreCatalog : function(){

                this.showCatalog = !this.showCatalog;
            },

            addTyre : function(id){
                console.log("addTyre("+id+")");
                for(var i=0; i<this.tyre_catalog.length; i++)
                {
                    if(tyre_catalog[i].tyre_id == id)
                    {
                        var obj = Object.assign ({}, tyre_catalog[i]);
                        console.log('obj');
                        console.log(obj);
                        this.proforma_invoice.push(obj);
                        break;
                    }
                }
            },

            removeTyre : function(index){

                this.proforma_invoice = this.proforma_invoice.filter(function(value, i, array){
                    // all items except for the current index
                    return index != i;
                });
            }
        }

    })
  </script>
@endsection