@extends('layouts.app')

@section('title')
  Orders
@endsection
@section('subtitle')
  Create a new Order.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Orders',
    'subcrumb' => 'Create a new Order',
     'link' => route('orders.create')])
  @endcomponent
@endsection

@section('body')

  <div v-cloak class="row justify-content-center">
    <transition  name="custom-classes-transition"
                 mode="out-in"
                 enter-active-class="animated fadeInRight fast"
                 leave-active-class="animated fadeOutLeft fast"
    >
      <div v-if="toggle==false" :key="false" class="col-xs-12 col-md-7">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="page-header ml-3"><i class="fa fa-dolly mr-3"></i>Enter new order information</h3>
          </div>
          <div class="box-body">
            <div class="form">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="inputCustomerId">Customer ID</label>
                      <select v-model="customer" id="customer" class="form-control">
                        <option :value="null">Select a customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">



                    <div id="itemList" class="">

                      <table class="table table-bordered table-striped">

                        <thead>
                          <tr>
                            <td style="width: 5%"  >#</td>
                            <td style="width: 45%" >Tyre</td>
                            <td style="width: 15%" >Qty</td>
                            <td style="width: 15%" >Unit Price</td>
                            <td style="width: 15%" class="text-right" >Subtotal</td>
                            <td style="width: 5%" ></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id="selector" class="selector" v-for="(content,index) in order_contents" style="display:none;">
                            <td style="width: 5%;" >@{{ index+1 }}</td>
                            <td style="width: 45%;" >@{{ content.brand }} @{{ content.size }} @{{ content.pattern }} @{{ content.lisi }}</td>
                            <td style="width: 15%;" ><div class="form-group" :class="{'has-error' : errors.qty && !parseInt(content.qty)>0}"><input class="text-right form-control " v-model="content.qty" type="number" step="1" min="1" value="1"></div></td>
                            <td style="width: 15%;" ><div class="form-group" :class="{'has-error' : errors.qty && !parseFloat(content.unit_price)>0}"><input class="text-right form-control" v-model="content.unit_price" type="number" step="1" min="1" value="1"></div></td>
                            <td style="width: 15%;" class="text-right" >৳ @{{ parseFloat(content.qty) * parseFloat(content.unit_price) | currency}}</td>
                            <td style="width: 5%;" >
                              <a class="text-danger" @click="remove(index)">
                                <i class="fas fa-minus-circle mt-1"></i>
                              </a>
                            </td>
                          </tr>

                          <tr id="subTotal" class="" style="display: none;">
                            <td style="width: 5%"></td>
                            <td style="width: 45%"><b>Total</b></td>
                            <td style="width: 15%" class="text-right" style="padding-right: 5%;"><b>@{{ totalQty }}</b></td>
                            <td style="width: 15%"></td>
                            <td style="width: 15%" class="text-right"  scope="col"><b>৳ @{{ subTotal | currency }}</b></td>
                            <td style="width: 5%" ></td>
                          </tr>

                          <tr id="discount" class="warning" style="display:none">
                            <td style="width: 5%"></td>
                            <td style="width: 45%"><b>Discount</b></td>
                            <td class="text-right" style="width: 30%" colspan="2"><i class="fas fa-minus"></i></td>
                            <td style="width: 15%" class="text-right"  scope="col"><b>৳ @{{ total_discount_amount | currency }}</b></td>
                            <td style="width: 5%" ></td>
                          </tr>
                          <tr id="tax" class="danger" style="display:none">
                            <td style="width: 5%"></td>
                            <td style="width: 45%"><b>Tax</b></td>
                            <td class="text-right" style="width: 30%" colspan="2"><i class="fas fa-plus"></i></td>
                            <td style="width: 15%" class="text-right"><b>৳ @{{ total_tax_amount | currency }}</b></td>
                            <td style="width: 5%" ></td>
                          </tr>
                          <tr id="grandTotal" class="info" style="display:none">
                            <td style="width: 5%"></td>
                            <td style="width: 45%"><h4 class="text-uppercase"><b>Grand Total</b></h4></td>
                            <td style="width: 45%" class="text-right"  colspan="3"><h4><b>৳ @{{ grandTotal | currency }}</b></h4></td>
                            <td style="width: 5%" ></td>
                          </tr>
                        </tbody>

                      </table>
                    </div>
                    <br>


                    <div v-if="order_contents.length" class="form-group col-xs-12 px-0">
                      <label for="inputTaxAmount" class="col-xs-12 col-md-2 control-label pl-0">Num items</label>
                      <div class="col-xs-3">
                        <input v-model="order_contents.length" type="text" class="form-control"  readonly>
                      </div>
                    </div>

                    <div class="form-group col-xs-12 px-0">
                      <label for="discountPercent" class="col-xs-12 control-label px-0">Discount</label>
                      <div class="col-xs-4 px-0">
                        <div class="input-group">
                          <input v-model="discount_percent" name="discountPercent" type="number" min="0" step="0.01" class="form-control" >
                          <div class="input-group-addon">
                            <i class="fas fa-percent"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <span class="text-center d-block mx-auto">and / or</span>
                      </div>
                      <div class="col-xs-4 px-0">
                        <div class="input-group">
                          <div class="input-group-addon"><b>৳</b></div>
                          <input v-model="discount_amount" type="text" class="form-control" >
                        </div>
                      </div>
                      <label v-if="discount_percentage_amount>0" class="col-xs-4 control-label  mt-4 px-0">
                        <i class="fas fa-equals ml-3 mr-5"></i>
                        {{--<i class="fas fa-minus mr-1"></i> --}}
                        ৳ @{{ discount_percentage_amount }}
                      </label>
                    </div>

                    <div class="form-group col-xs-12 px-0">
                      <label for="inputDiscountPercent" class="col-xs-12 control-label px-0">Tax</label>
                      <div class="col-xs-4 px-0">

                        <div class="input-group">
                          <input v-model="tax_percent" type="number" class="form-control">
                          <div class="input-group-addon">
                            <i class="fas fa-percent"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <span class="text-center d-block mx-auto">and / or</span>
                      </div>
                      <div class="col-xs-4 px-0">
                        <div class="input-group">
                          <div class="input-group-addon"><b>৳</b></div>
                          <input v-model="tax_amount" type="text" class="form-control" >
                        </div>
                      </div>
                      <label class="col-xs-4 control-label  mt-4 px-0">
                        <i class="fas fa-equals ml-3 mr-5"></i>
                        {{--<i class="fas fa-minus mr-1"></i> --}}
                        ৳ 400
                      </label>
                    </div>
                  </div>
                </div>
                {{--<div class="row">--}}
                  {{--<div class="col-xs-12">--}}

                  {{----}}

                  {{--<span class="col-md-3 col-md-offset-3"><i>and / or</i></span><br>--}}

                  {{----}}


                  {{----}}

                  {{--<span class="col-md-3 col-md-offset-3"><i>and / or</i></span><br>--}}
                {{--</div>--}}
                {{--</div>--}}

              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-xs-12">
                    <button type="button" class="btn btn-info pull-right" @click="continue_f()">
                      Continue
                      <i class="fa fa-chevron-right pt-1 ml-2"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="toggle==true" :key="true" class="col-xs-12">
        <section class="invoice">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fas fa-check mr-3 text-success"></i>Confirm new Order Information
                <small class="pull-right">Date: 2/10/2014</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>

          <div class="row invoice-info">

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <small class="text-uppercase">Bill To</small><br>
              <address>

              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <small class="text-uppercase">Beneficiary</small><br>
              <address>
                <b>Intertrac Nano</b> <br>
                7/5 Ring Road, Shyamoli, <br>
                Dhaka -1207
              </address>
            </div>

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order # </b><br>
            </div>

          </div>

          <div class="row mt-4">
            <div class="col-xs-12 ">
              <table class="table table-striped table-responsive">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Tyre</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Sub-total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(record, index) in order_contents">
                  <td>@{{ index+1 }}</td>
                  <td>@{{ record.brand }} @{{ record.size }} @{{ record.pattern }}  @{{ record.lisi }}</td>
                  <td>@{{ record.qty }}</td>
                  <td>৳ @{{ record.unit_price | currency }}</td>
                  <td>৳ @{{ record.qty*record.unit_price | currency }}</td>
                </tr>
                <tr class="warning">
                  <td></td>
                  <td><b>Total</b></td>
                  <td><b>@{{ totalQty }}</b></td>
                  <td></td>
                  <td>৳ @{{ subTotal | currency }}</td>
                </tr>

                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="row">
                <p class="lead ml-5">Additional information</p>
              </div>
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Add orders are final after confirming. Payments can be made against the order number. You can print
                this after finalizing.
              </p>
            </div>

            <div class="col-xs-6">
              <div class="table-responsive mt-5 pt-3">
                <table class="table">
                  <tbody>
                    <tr>
                      <th style="width: 60%;" colspan="2">Subtotal:</th>
                      <td>৳ @{{ subTotal | currency }}</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Tax</th>
                      <td><i class="fas fa-plus mr-2"></i></td>
                      <td>৳ @{{ total_tax_amount | currency }}</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Discount</th>
                      <td><i class="fas fa-minus mr-2"></i></td>
                      <td>৳ @{{ total_discount_amount | currency }}</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th colspan="2" style="border-top: 1px solid #bbb;">Grand Total:</th>
                      <td style="border-top: 1px solid #bbb;"><b>৳ @{{ grandTotal | currency }}</b></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
              <button @click="back()" type="button" class="btn btn-primary" style="margin-right: 5px;">
                <i class="fa fa-chevron-left mr-2"></i> Back
              </button>
              <button type="button" class="btn btn-success pull-right"><i class="fa fa-check mr-2"></i> Confirm Order
              </button>

            </div>
          </div>
        </section>
      </div>
    </transition>
    <transition  name="custom-classes-transition"
                 mode="out-in"
                 enter-active-class="animated fadeInRight fast"
                 leave-active-class="animated fadeOutRight fast"
    >
    <div v-if="toggle==false" class="col-xs-12 col-md-5">
      <div class="box box-default">
        <div class="box-header">
          <h3 class="page-header ml-3"><i class="fa fa-dolly mr-3"></i>Current Stock</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              @include('partials.currentstock')
            </div>
          </div>
        </div>
      </div>
    </div>
    </transition>
  </div>



@endsection

@section('footer-scripts')
  <style>
    .leftDiv{
      width : 50%;
      float : left;
      margin : auto;
    }
    .rightDiv{
      width : 50%;
      float : right;
      margin : auto;
    }

    .input{
      width: 25%;
    }

  </style>
  <script src="/js/addItem.js"></script>

  <script>

    var stock = JSON.parse('{!! json_encode($in_stock) !!}');

    // var OrderItem = new Vue.component('OrderItem', {
    //
    // });

    var app = new Vue({
        el: '#app',
        data: {
            stock : stock,
            order_contents : [],
            errors : [],
            toggle : false,

            discount_percent : 0,
            discount_amount : 0,
            tax_percent : 0,
            tax_amount : 0,
            customer : null,
        },

        watch: {

            discount_percent : function(new_val)
            {
                app.helperPositiveFloat(new_val, "discount_percent");

            },

            discount_amount : function(new_val)
            {
                app.helperPositiveFloat(new_val, "discount_amount");

            },

            tax_percent : function(new_val)
            {
                app.helperPositiveFloat(new_val, "tax_percent");

            },

            tax_amount : function(new_val)
            {
                app.helperPositiveFloat(new_val, "tax_amount");

            },

            total_discount_amount : function(new_val, old_val)
            {


                if(parseFloat(new_val)>0 && !(parseFloat(old_val)>0))
                    $("#discount").fadeIn(400);
                else if(!parseFloat(new_val)>0 && parseFloat(old_val)>0)
                    $("#discount").fadeOut(400);
            },

            total_tax_amount : function(new_val, old_val)
            {

                if(parseFloat(new_val)>0 && !(parseFloat(old_val)>0))
                    $("#tax").fadeIn(400);
                else if(!parseFloat(new_val)>0 && parseFloat(old_val)>0)
                    $("#tax").fadeOut(400);
            },

            subTotal : function(new_val, old_val)
            {

                if(parseFloat(new_val)>0 && !(parseFloat(old_val)>0))
                    $("#subTotal").fadeIn(400);
                else if(!parseFloat(new_val)>0 && parseFloat(old_val)>0)
                    $("#subTotal").fadeOut(400);

            },

            grandTotal : function(new_val, old_val)
            {
                if(isNaN(new_val))
                    new_val = 0;
                if(parseFloat(new_val)>0 && !(parseFloat(old_val)>0))
                    $("#grandTotal").fadeIn(400);
                else if(!parseFloat(new_val)>0 && parseFloat(old_val)>0)
                    $("#grandTotal").fadeOut(400);

            }


        },

        computed: {

            total_discount_amount : function(){

              var ret = 0;

              if(parseFloat(this.subTotal)>0 && parseFloat(this.discount_percent)>=0 && parseFloat(this.discount_percent)<100 && this.discount_amount>=0)
                ret = parseFloat(this.subTotal) * parseFloat(this.discount_percent) /100.0 + parseFloat(this.discount_amount);

              return ret;
            },

            discount_percentage_amount : function(){
                var ret = 0;

                if(parseFloat(this.subTotal)>0 && parseFloat(this.discount_percent)>=0 && parseFloat(this.discount_percent)<100)
                    ret = parseFloat(this.subTotal) * parseFloat(this.discount_percent) /100.0

                return ret;

            },

            total_tax_amount : function(){

                var ret = 0;

                if(parseFloat(this.subTotal)>0 && parseFloat(this.tax_percent)>=0 && parseFloat(this.tax_percent)<100 && this.tax_amount>=0)
                    ret = parseFloat(this.subTotal) * parseFloat(this.tax_percent) /100.0 + parseFloat(this.tax_amount);

                return ret;
            },
            subTotal : function(){

                var ret = 0;

                this.order_contents.forEach(function(item){
                    if(parseInt(item.qty)>0 || parseFloat(item.unit_price)>0)
                        ret += (parseInt(item.qty) * parseFloat(item.unit_price));
                });

                return ret;
            },

            grandTotal : function(){

                return (this.subTotal + this.total_tax_amount - this.total_discount_amount);
            },

            totalQty : function(){
                var ret = 0;

                this.order_contents.forEach(function(item){
                    if(parseInt(item.qty)>0)
                        ret += parseInt(item.qty);
                });

                return ret;

            }
        },

        methods:{


            add : function(index){
                this.order_contents.push(this.stock[index]);

                this.$nextTick(function(){
                    $('#selector').fadeIn(300, function(){
                        $('#selector').removeAttr('id');
                    });
                });
            },

            remove : function(index){

                console.log('remove called');

                $('tr.selector').eq(index).fadeOut(300, function(){
                    app.order_contents.splice(index,1);
                    $('tr.selector').show(); // because it keeps hiding a second one. BUT WHY ? :@
                });
            },

            validate : function(){
                var errors = [];

                console.log('IN VALIDATE');

                this.order_contents.forEach(function(item){

                    console.log('item');
                    console.log(item);
                    if(!(parseInt(item.qty) > 0))
                        errors['qty'] = "Quantity must be greater than zero (0).";
                    if(!(parseFloat(item.unit_price) > 0))
                        errors['unit_price'] = "Unit price must be greater than zero (0).";



                });

                if( Object.entries(errors).length) // because errors is an obj and does not have length
                    return { status : 'error', 'errors' : errors };
                return {status : 'success'};
            },

            continue_f : function(){

                var validate =  this.validate();

                if(validate.status == 'success')
                    this.toggle = true;

                else if(validate.errors)//errors
                    this.errors = validate.errors;
            },

            back : function(){
                this.toggle = false;


                setTimeout(function(){

                    $('tr.selector').fadeIn(300);
                    $('#subTotal').fadeIn(300);
                    $('#grandTotal').fadeIn(300);

                    if(app.total_discount_amount>0)
                      $('#discount').fadeIn(300);

                    if(app.total_tax_amount>0)
                        $('#tax').fadeIn(300);
                }, 2000);
            },

            save : function(){

                $.post("{{route('orders.store')}}",
                    {
                        "_token" : "{{csrf_token()}}",

                        "customer" : this.customer,
                        "order_contents" : this.order_contents
                    },
                    function(data){

                      if(data.status == 'success')
                          app.is_complete = true;

                    });
            },

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

    })

  </script>
@endsection


