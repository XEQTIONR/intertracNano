@extends('layouts.app')

@section('title')
  Letters of credit
@endsection
@section('subtitle')
  All LCs applied for.
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
                  enter-active-class="animated fadeInRight fast"
                  leave-active-class="animated fadeOutLeft fast ">
        <div  v-if="showForm == 0" key="1" class="col-xs-12 col-md-6">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">1. Enter LC Information</h3>
            </div>
            <div class="box-body">

              <form>
                <div class="box-body">

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>LC#</label>
                      <div class="input-group">
                        <span class="input-group-addon">F20</span>
                        <input id="lcNum" v-model="lc.lc_num" type="text" class="form-control" placeholder="Enter letter of credit number">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Date Issued</label>
                      <div class="input-group">
                        <span class="input-group-addon">F31C</span>
                        <input  v-model="lc.date_issued" id="dateIssued" type="text" class="form-control date">
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
                        <input  v-model="lc.date_expired" id="dateExpiry" type="text" class="form-control date">
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
                        <textarea v-model="lc.applicant" class="form-control" rows="3" placeholder="Enter applicant name and address"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Beneficiary</label>
                      <div class="input-group">
                        <span class="input-group-addon">F50</span>
                        <textarea  v-model="lc.beneficiary" class="form-control" rows="3" placeholder="Beneficiary name and address"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Departing Port</label>
                      <div class="input-group">
                        <span class="input-group-addon">F44E</span>
                        <input v-model="lc.departing_port" type="text" class="form-control" placeholder="Enter departing port">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Arriving Port</label>
                      <div class="input-group">
                        <span class="input-group-addon">F44F</span>
                        <input v-model="lc.arriving_port" type="text" class="form-control" placeholder="Enter departing port">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Foreign currency code</label>
                      <div class="input-group">
                        <span class="input-group-addon">F32B</span>
                        <input v-model="lc.currency_code" type="number" class="form-control" placeholder="Currency Code">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-8">
                    <div class="form-group">
                      <label>LC Value (in foreign currency)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>$</strong></span>
                        <input v-model="lc.lc_value" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Exchange Rate</label>
                      <div class="input-group">

                        <input v-model="lc.exchange_rate" type="number" step="0.01" class="form-control" placeholder="0.00">
                        <span class="input-group-addon"><strong>/ $</strong></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-8">
                    <div class="form-group">
                      <label>LC Value (in local currency) </label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Expenses Paid (Foreign)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>$</strong></span>
                        <input v-model="lc.expense_foreign" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>Expenses Paid (Local)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input v-model="lc.expense_local" type="number" step="0.01" class="form-control" placeholder="Enter Departing Port" value="0.00">
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Notes</label>
                      {{--<div class="input-group">--}}
                      {{--<span class="input-group-addon">F50</span>--}}
                      <textarea v-model="lc.notes" class="form-control" rows="3" placeholder="Any additonal information you want to record about this LC"></textarea>
                      {{--</div>--}}

                    </div>
                    <div class="col-12">
                      <button type="button" onclick="console.log(document.getElementById('dateIssued').value)" class="btn btn-primary btn-lg pull-right">Submit</button>
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
        <div  v-if="showForm == 1" key="0"  class="col-xs-7">
          {{--<div class="col-xs-7">--}}
            {{--<div class="box">--}}
              {{--<button @click="add()">Click Me!</button>--}}
              {{--<transition-group name="list" tag="div">--}}
                {{--<span v-for="item in jaitems" class="list-item" :key="item.id">--}}
                  {{--@{{ item.name }}--}}
                {{--</span>--}}
              {{--</transition-group>--}}
            {{--</div>--}}
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">2. Enter Proforma Invoice</h3>
              </div>
              <div class="box-body">

                <form style="padding: 1rem;">
                  <div class="row">
                    <div class="col-xs-1 text-center"><strong>#</strong></div>
                    <div class="col-xs-4 text-center"><strong>Tyre</strong></div>
                    <div class="col-xs-2 text-center"><strong>Qty</strong></div>
                    <div  class="col-xs-2 text-center"><strong>Unit Price</strong></div>
                    <div  class="col-xs-2 text-center"><strong>Sub Total</strong></div>
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
                    <div class="row list-item" v-for="(item,index) in proforma_invoice" v-bind:key="item.tyre_id" >
                      {{--<div class="row">--}}
                      <div class="col-xs-1 text-center">
                        @{{ index+1 }}
                      </div>
                      <div class="col-xs-5">
                        @{{item.brand}} @{{item.size}} @{{ item.lisi }} @{{item.pattern}}
                      </div>
                      <div class="col-xs-2">
                        <input class="text-right" v-model="item.qty" type="number" step="1" min="1" value="1">
                      </div>
                      <div class="col-xs-2">
                        <input class="text-right" v-model="item.unit_price" type="number" step="0.01" min="0.01" value="0.01">
                      </div>
                      <div class="col-xs-2 text-right">
                        @{{ subTotal(index) }}
                      </div>
                      <div class="col-xs-1">
                        <a class="text-danger" @click="removeTyre(index)">
                          <i class="fas fa-minus-circle"></i>
                        </a>
                      </div>
                      {{--</div>--}}
                    </div>
                    </transition-group>
                    <div class="row list-item mt-2 pt-2" style="border-top: 2px solid black;">
                      <div class="col-xs-8">
                        <strong>Grand Total</strong>
                      </div>
                      <div class="col-xs-3 text-right">
                        <strong>@{{grand_total}}</strong>
                      </div>
                      <div class="col-xs-1"></div>
                    </div>


                    {{--</tbody>--}}
                  {{--</ol>--}}
                </form>
              </div>
            </div>

        </div>


      </transition>
      <transition name="custom-classes-transition" enter-active-class="animated fadeInRight delay-1s" leave-active-class="animated fadeOutLeft" >
        <div v-show="showForm == 1" class="col-xs-5">
          <div class="box">
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
  <button type="button" @click="toggle()">Toggle</button>
@endsection

@section('footer-scripts')

  <script>
      var tyre_catalog = JSON.parse('{!! json_encode($tyres) !!}');




    var app = new Vue({
        el: '#app',
        data: {
            showForm : 0,
            showCatalog : false,
            tyre_catalog : tyre_catalog,

            lc : {
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
                notes : null
            },

            proforma_invoice : [],

            invoice_record : {}

        },
        computed:{
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
            }
        },
        methods: {
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

            add: function() {
                this.jaitems.push({ id: 6, name: "Zoe" });
            },

            toggle : function(){
                (this.showForm  == 1) ? this.showForm = 0 : this.showForm++;
                $(".date").inputmask("dd/mm/yyyy");
                 //$('#table_id').DataTable();
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
                        // Not sure why, but Object.assign sets tyre_id to 1 and actual id to new field 'id'
                        //obj.tyre_id = obj.id;
                        console.log('obj');
                        console.log(obj);
                        this.proforma_invoice.push(obj);
                        break;
                    }
                }
            },

            removeTyre : function(index){

                this.proforma_invoice = this.proforma_invoice.filter(function(value, i, array){

                    return index != i;
                });
            }
        },

    })
  </script>
@endsection