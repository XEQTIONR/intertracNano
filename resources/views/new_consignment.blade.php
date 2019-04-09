@extends('layouts.app')

@section('title')
  Consignments
@endsection
@section('subtitle')
  Add a new consignment arrived.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Consingments',
    'subcrumb' => 'An a consignment',
     'link' => route('consignments.index')])
  @endcomponent
@endsection

@section('body')

  <div class="row justify-content-center">
    <div class="col-xs-12">
      <transition name="custom-classes-transition"
                  enter-active-class="animated fadeIn faster"
                  leave-active-class="animated fadeOut faster"
      >
        <div v-if="is_alert" id="alert" class="alert" :class="alert_class" role="alert">
          <button type="button" class="close" aria-label="Close"><span @click="dismiss_warning()" aria-hidden="true">&times;</span></button>
          <h4><i class="icon fa fa-warning"></i> No Proforma Invoice !</h4>
          You have not entered a proforma invoice. It is recommended that you enter proforma invoice information.
          <button @click="toggle(true)" type="button" class="btn btn-warning ml-5">Click here to skip (not recommended)</button>
        </div>
        <div v-if="is_complete" id="alert" class="alert alert-success"  role="alert">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert"><span @click="dismiss_warning()" aria-hidden="true">&times;</span></button>
          <h4><i class="icon fa fa-check-circle"></i> Done</h4>
          New consignment has been recorded.
          <a href="{{ route('lcs.index') }}"  class="btn btn-success ml-5">Click here to view all LCs</a>
        </div>
      </transition>
    </div>
  </div>
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
            <h3 class="page-header ml-3">
              <i class="far fa-anchor mr-3"></i>
              Enter Consignment Information
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">

            <form>
              <div class="box-body">
                <div class="row mx-2">
                  <div class="col-xs-12">
                    <div class="form-group" :class="{ 'has-error' :  errors.bol }">
                      <label>Bill of Lading #</label>
                        <input id="bol" v-model="bol" type="text" class="form-control" placeholder="Enter Bill of lading number">
                      {{--</div>--}}
                      <span v-if=" errors.bol" class="help-block text-danger">@{{ errors.bol }}</span>
                    </div>
                  </div>
                </div>

                <div class="row mx-2">
                  <div class="col-xs-12">
                    <div class="form-group" :class="{ 'has-error' :  errors.lc_num }">
                      <label>Letter of Credit #</label>
                      {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon">--}}
                          {{--<span v-if="!is_verifying">F20</span>--}}
                          {{--<i v-else class="fas fa-spinner fa-pulse"></i>--}}
                        {{--</span>--}}
                        {{--<input type="text" class="form-control" placeholder="Enter LC number">--}}
                      <select id="lc_num" v-model="lc_num" class="form-control" placeholder="select an LC">
                        <option disabled :value="null">Select a LC</option>
                        <option v-for="lc in lcs" :value="lc.lc_num">@{{lc.lc_num}}</option>
                      </select>

                      {{--</div>--}}
                      {{--<span v-if=" errors.bol" class="help-block text-danger">@{{ errors.bol }}</span>--}}
                    </div>
                  </div>
                </div>

                <div class="row mx-2">
                  <div class="col-xs-12 col-md-5">
                    <div class="form-group" :class="{ 'has-error' :  errors.date_issued }">
                      <label>Land Date</label>
                      <div class="input-group">
                        <span class="input-group-addon">F31C</span>
                        <input v-model="date1"  @click="datetify()" @blur="copyDate(1)" id="dateIssued" type="text" class="form-control date">
                        <div class="input-group-addon">
                          <i class="fas fa-calendar-alt"></i>
                        </div>
                      </div>
                      <span v-if=" errors.date_issued" class="help-block text-danger">@{{ errors.date_issued }}</span>
                    </div>
                  </div>

                  <div class="col-xs-7">
                    <div class="form-group" :class="{ 'has-error' :  errors.lc_value }">
                      <label>Value (in foreign currency)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>@{{currency_symbol}}</strong></span>
                        <input v-model="value" type="number" step="0.01" class="form-control" placeholder="0.00" min="0.00">
                      </div>
                      <span v-if=" errors.value" class="help-block text-danger">@{{ errors.lc_value }}</span>
                    </div>

                  </div>
                </div>
                <div class="row mx-2">



                  <div class="col-xs-5">
                    <div class="form-group" :class="{ 'has-error' :  errors.exchange_rate }">
                      <label>Exchange Rate</label>
                      <div class="input-group">

                        <input v-model="exchange_rate" type="number" step="0.01" class="form-control" placeholder="0.00">
                        <span class="input-group-addon"><strong>/ @{{currency_symbol}}</strong></span>
                      </div>
                      <span v-if=" errors.exchange_rate" class="help-block text-danger">@{{ errors.exchange_rate }}</span>
                    </div>
                  </div>


                  <div class="col-xs-12 col-md-7">
                    <div class="form-group">
                      <label>Consignment Value (in local currency) </label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input type="number" step="0.01" class="form-control" :value="value_local | currency" disabled>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mx-2">

                  <div class="col-xs-12 col-md-5">
                    <div class="form-group">
                      <label>Tax Paid</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input v-model="tax" type="number" step="0.01" min="0" class="form-control" placeholder="0.00">
                      </div>
                      <span class="help-block"></span>
                    </div>
                  </div>

                  <div class="col-xs-12 col-md-7">
                    <div class="form-group">
                      <label>Expenses Paid (Foreign)</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>@{{currency_symbol}}</strong></span>
                        <input v-model="expense_foreign" type="number" step="0.01" min="0" class="form-control" placeholder="0.00">
                      </div>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
                <div class="row mx-2">

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Total Cost to obtain consignment</label>
                      <div class="input-group">
                        <span class="input-group-addon"><strong>৳</strong></span>
                        <input :value="total_cost | currency" type="number" step="0.01" min="0" class="form-control" disabled placeholder="0.00">
                      </div>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>

                <div class="row mx-2">
                  <div class="col-xs-12">
                      <button v-if="!is_duplicate" type="button" class="btn btn-info pull-right" @click="submit()">
                        Continue
                        <i class="fa fa-chevron-right pt-1 ml-2"></i>
                      </button>
                  </div>
                </div>

              </div>
            </form>


          </div>
        </div>
      </div>

      <div  v-if="showForm == 1" key="1"  class="col-xs-7">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="page-header ml-3"><i class="far fa-container-storage mr-3"></i> Add containers to your consignment</h3>
          </div>
          <div class="box-body pb-5 pl-5 pr-5">


            <form style="padding: 1rem;">

              <div v-for="(container, index) in containers" @click="select_container(index)" class="row" {{--:Class="{'border-dash' : selected_container == index}"--}}  style="flex-direction: column">
                <div class="box box-solid" :id="container.container_num" :class="[selected_container == index ? 'box-warning' : 'box-default']">

                  <div class="box-header">
                    <h4 class="box-title"><i class="far fa-container-storage mr-3"></i> # @{{ container.container_num }}</h4>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" :id="container.container_num + '_close'"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="box-body px-0 pb-0">
                      {{--<button type="button" @click="test()" class="btn btn-primary">Click me</button>--}}
                      <div class="col-xs-12" style="min-height: 100px">
                        <div class="row list-item pb-1">
                          <div class="col-xs-1 text-center"><strong>#</strong></div>
                          <div class="col-xs-2 text-center"><strong>Tyre</strong></div>
                          <div class="col-xs-2 text-center"><strong>Qty</strong></div>
                          <div  class="col-xs-2 text-right"><strong>Unit Price</strong></div>
                          <div class="col-xs-2 text-center"><strong>Total Weight (kg)</strong></div>
                          <div class="col-xs-2 text-center"><strong>Total Tax</strong></div>
                          <div  class="col-xs-1 text-right"><strong>Sub Total</strong></div>
                          <div  class="col-xs-1 text-right"></div>
                        </div>

                        <div v-for="(item, item_index) in container.contents"  class="row py-2" :class="{'bg-light-gray' : !(item_index%2)}">
                          <div class="col-xs-1 text-center"><strong>@{{ item_index + 1 }}</strong></div>
                          <div class="col-xs-2 text-center">@{{item.brand}} @{{item.size}} @{{ item.lisi }} @{{item.pattern}}</div>
                          <div class="col-xs-2 text-center"><input class="form-control" v-model="item.qty" type="number" min="0" step="1"></div>
                          <div class="col-xs-2 text-center"><input class="form-control" v-model="item.unit_price" type="number" min="0" step="1"></div>
                          <div class="col-xs-2 text-center"><input class="form-control" v-model="item.total_weight" type="number" min="0" step="1"></div>
                          <div  class="col-xs-2 text-right"><input class="form-control" v-model="item.total_tax" type="number" min="0" step="1"></div>
                          <div  class="col-xs-1 text-right"><strong>@{{ exchange_rate * item.unit_price * item.qty | currency }}</strong></div>
                          <div class="col-xs-1">
                            <a class="text-danger" @click="removeTyre(index, item_index)">
                              <i class="fas fa-minus-circle mt-1"></i>
                            </a>
                          </div>
                        </div>


                      </div>

                  </div>
                </div>
              </div>
                  <div class="mb-4 btn btn-success btn-block">
                <transition  name="custom-classes-transition"
                                   {{--tag="ol"--}}
                                   mode="out-in"
                                   {{--enter-class = "mimi"--}}
                                   enter-active-class="animated fadeIn fast"
                                   {{--enter-class="animated tada"--}}
                                   leave-active-class="animated fadeOutRight fast "
                >
                  <div v-if="container_step==0" key="0" @click="container_step=1" class="row justify-content-center align-items-center p-5">
                        <span class="mr-2" style="font-size: 10px"><i class="fas fa-plus"></i></span>
                        <i style="font-size: 20px;" class="far fa-container-storage mr-3"></i>
                        <span style="font-size : 15px;"><b> Add a container</b></span>
                  </div>
                  <div v-if="container_step==1" key="1" class="row justify-content-center align-items-center p-5 ">

                    <i style="font-size: 20px;" class="far fa-container-storage mr-3"></i>
                    <span style="font-size : 15px;"><b>#</b></span>
                    <input v-model="container_num" type="text" class="ml-3" placeholder="Enter Container Number">
                    <button @click="add_container()" type="button" class="btn btn-success ml-2">Add</button>
                    <button @click="container_step=0" type="button" class="btn btn-warning mr-2">Cancel</button>
                  </div>
                </transition>
              </div>

              {{--<div v-if=" errors.qty" class="row ml-3 mb-2 text-danger">@{{ errors.qty }}</div>--}}
              {{--<div v-if=" errors.unit_price" class="row ml-3 mb-2 text-danger">@{{ errors.unit_price }}</div>--}}
              {{--<div class="row pb-1">--}}
                {{--<div class="col-xs-1 text-center"><strong>#</strong></div>--}}
                {{--<div class="col-xs-4 text-center"><strong>Tyre</strong></div>--}}
                {{--<div class="col-xs-2 text-center"><strong>Qty</strong></div>--}}
                {{--<div class="col-xs-2 text-center"><strong>Total Weight</strong></div>--}}
                {{--<div class="col-xs-2 text-center"><strong>Total Tax</strong></div>--}}
                {{--<div  class="col-xs-2 text-right"><strong>Unit Price</strong></div>--}}
                {{--<div  class="col-xs-2 text-right"><strong>Sub Total</strong></div>--}}
                {{--<div class="col-xs-1"></div>--}}
              {{--</div>--}}
              {{--<ol class="table ">--}}


              {{--<tbody>--}}
              {{--<transition-group  name="custom-classes-transition"--}}
                                 {{--tag="ol"--}}
                                 {{--mode="out-in"--}}
                                 {{--enter-class = "mimi"--}}
                                 {{--enter-active-class="animated fadeInDown"--}}
                                 {{--enter-class="animated tada"--}}
                                 {{--leave-active-class="animated fadeOutUp fast "--}}
              {{-->--}}
                {{--<div v-if="!proforma_invoice.length" key="default" class="row list-item justify-content-center my-4">--}}
                  {{--<span class="text-center "> Nothing in the proforma invoice yet</span>--}}
                {{--</div>--}}
                {{--<div class="row list-item pt-4" :class="{'bg-light-gray' : !(index%2)}" v-for="(item,index) in proforma_invoice" :key="item.tyre_id" >--}}
                  {{--<div class="row">--}}
                  {{--<div class="col-xs-1 text-center">--}}
                    {{--@{{ index+1 }}--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-4">--}}
                    {{--@{{item.brand}} @{{item.size}} @{{ item.lisi }} @{{item.pattern}}--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-2 form-group" :class="{'has-error' : item.qty==0}">--}}
                    {{--<input class="text-right form-control" v-model="item.qty" type="number" step="1" min="1" value="1">--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-2 form-group"  :class="{'has-error' : item.unit_price==0}">--}}
                    {{--<input class="text-right form-control" v-model="item.unit_price" type="number" step="0.01" min="0.01" value="0.01">--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-2 form-group"  :class="{'has-error' : item.unit_price==0}">--}}
                    {{--<input class="text-right form-control" v-model="item.total_weight" type="number" step="0.01" min="0.01" value="0.01">--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-2 form-group"  :class="{'has-error' : item.unit_price==0}">--}}
                    {{--<input class="text-right form-control" v-model="item.total_tax" type="number" step="0.01" min="0.01" value="0.01">--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-2 text-right">--}}
                    {{--@{{ currency_symbol }} @{{ subTotal(index) | currency}}--}}
                  {{--</div>--}}
                  {{--<div class="col-xs-1">--}}
                    {{--<a class="text-danger" @click="removeTyre(index)">--}}
                      {{--<i class="fas fa-minus-circle mt-1"></i>--}}
                    {{--</a>--}}
                  {{--</div>--}}
                  {{--</div>--}}
                {{--</div>--}}
              {{--</transition-group>--}}
              {{--<div class="row list-item pt-2 border-light-gray">--}}
                {{--<div class="col-xs-8 col-sm-3 col-sm-offset-5">--}}
                  {{--<strong class="font-light-gray">Grand Total</strong>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4 text-right mr-invoice">--}}
                  {{--<strong>@{{ currency_symbol }} @{{grand_total | currency}}/-</strong>--}}
                {{--</div>--}}
              {{--</div>--}}

              {{--<div class="row list-item mt-2 pt-2">--}}
                {{--<div class="col-xs-8 col-sm-3 col-sm-offset-5">--}}
                  {{--<strong>Grand Total <br>(in Taka)</strong>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4 text-right mr-invoice">--}}
                  {{--৳ @{{(grand_total* exchange_rate) | currency}}/---}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="row list-item mt-2 pt-2">--}}
                {{--<div class="col-xs-8 col-sm-3 col-sm-offset-5">--}}
                  {{--<strong>Total Qty</strong>--}}
                {{--</div>--}}
                {{--<div class="col-xs-4 text-right mr-invoice pr-1">--}}
                  {{--@{{ total_qty }}--}}
                {{--</div>--}}
              {{--</div>--}}
            </form>


            <button type="button" class="btn btn-default" @click="toggle(false)">
              <i class="fa fa-chevron-left pt-1 mr-2"></i>
              Back
            </button>
            <button type="button" class="btn btn-info pull-right" @click="submit()">
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

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>LC # @{{ lc_num }}</b><br>
              <br>

              <b>Date Issued:</b> @{{ date_issued }}<br>
              <b>Date Expiry:</b> @{{ date_expired }}<br>
            </div>

          </div>

          <!-- Table row -->
          <div class="row mt-4">
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
            <div class="col-xs-6">
              <div class="row">
                <p class="lead ml-5">Additional information</p>
              </div>
              <div class="row invoice-info well ml-1 mr-1 mb-4">
                <div class="col-sm-6 invoice-col">
                  <b>Foreign Currency Code:</b> @{{ currency_code }}<br>
                  <b>Exchange Rate:</b> ৳ @{{ exchange_rate | currency }} / @{{ currency_symbol }}<br>
                  <br>
                  <b>Departing Port:</b> @{{ departing_port }}<br>
                  <b>Arriving Port:</b> @{{ arriving_port }}<br>

                </div>

                <div class="col-sm-6 invoice-col">
                  <b>Expenses Foreign: </b> @{{ currency_symbol }} @{{ expense_foreign | currency }}<br>
                  <b>Expenses Local: </b> ৳ @{{ expense_local }}<br>
                  <br>
                  <b>LC Value : </b>@{{ currency_symbol }} @{{ lc_value | currency }}<br>
                  <b>LC Value in Taka: </b> ৳ @{{ lc_value*exchange_rate | currency }}<br>

                </div>

                <!-- /.col -->
              </div>
            </div>
            <div class="col-xs-6">
              {{--<p class="lead">Amount Due 2/22/2014</p>--}}

              <div class="table-responsive mt-5 pt-3">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Grand Total</th>
                    <td>@{{ currency_symbol }} @{{ grand_total | currency }}</td>
                  </tr>
                  <tr>
                    <th>Grand Total in TK</th>
                    <td>৳ @{{ grand_total*exchange_rate | currency }}</td>
                  </tr>
                  <tr>
                    <th>Expenses Foreign</th>
                    <td>@{{ currency_symbol }} @{{ expense_foreign }}</td>
                  </tr>
                  <tr>
                    <th>Expense Local:</th>
                    <td>৳ @{{ expense_local }}</td>
                  </tr>
                  </tbody></table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div v-if="!is_complete" class="row no-print">
            <div class="col-xs-12 border-light-gray pt-3">
              <button type="button" class="btn btn-default" @click="toggle(false)">
                <i class="fa fa-chevron-left pt-1 mr-2"></i>
                Back
              </button>
              <button type="button" class="btn btn-success pull-right" @click="toggle(true)">
                <i class="fas fa-check mr-2"></i>
                Confirm
              </button>
            </div>
          </div>
        </section>


      </div>
    </transition>
    <transition name="custom-classes-transition"
                :enter-active-class="direction? 'animated fadeInRight delay-1s fast' : 'animated fadeInLeft delay-1s fast'"
                :leave-active-class="direction? 'animated fadeOutLeft fast' : 'animated fadeOutRight fast'" >
      <div v-show="showForm == 1 && containers.length && selected_container != null" class="col-xs-5">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tyre Catalog</h3>
          </div>
          <div class="box-body">
            <table id ="table_id" class="table table-hover table-bordered">
              <thead>
              <tr>
                <th><i class="fas fa-tire"></i> ID</th>
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
  </div>

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


              lcs : JSON.parse('{!! json_encode($lcs) !!}'),
              lc_num : null,
              bol: null,

              tax : null,
              date_issued : null,
              date_expired : null,
              currency_code : null,
              exchange_rate : null,
              value : null,
              expense_foreign : null,

              proforma_invoice : [],

              containers : [],
              container_step : 0,
              container_num : null,
              selected_container : null,

              direction : true,

              date_flag: false,
              date1: null,
              currency_symbol: '$',

              errors : [],
              is_alert : false,
              is_complete : false,
              is_duplicate : false,

              is_verifying : false,

              alert_class : 'alert-warning',



          },
          computed:{



              value_local : function()
              {
                  var ret_val = 0;
                  if(!isNaN(parseFloat(this.value))  && !isNaN(parseFloat(this.exchange_rate)))
                      ret_val = this.value * this.exchange_rate;
                  return ret_val;
              },

              total_cost :function()
              {
                  var ret_val = 0;

                  if(!isNaN(parseFloat(this.value)) && !isNaN(parseFloat(this.exchange_rate)))
                  {
                      ret_val = parseFloat(this.value)* parseFloat(this.exchange_rate);
                      if(!isNaN(parseFloat(this.tax)))
                          ret_val = ret_val + parseFloat(this.tax);

                      if(!isNaN(parseFloat(this.expense_foreign)))
                          ret_val = ret_val + (parseFloat(this.expense_foreign)*parseFloat(this.exchange_rate));
                  }
                  return ret_val;

              },
              //
              // grand_total : function(){
              //
              //     var ret_val = 0;
              //     if(this.proforma_invoice.length)
              //     {
              //
              //         this.proforma_invoice.forEach(function(value, index){
              //
              //             if(
              //                 typeof (value.qty) !== 'undefined' &&
              //                 typeof (value.unit_price) !== 'undefined' &&
              //                 value.qty.length &&
              //                 value.unit_price.length
              //             )
              //                 ret_val += parseInt(value.qty) * parseFloat(value.unit_price)
              //
              //         });
              //
              //
              //     }
              //     return ret_val;
              // },
              //
              // total_qty : function(){
              //
              //     var ret_val = 0;
              //
              //     this.proforma_invoice.forEach(function(value){
              //         ret_val += parseInt(value.qty);
              //     });
              //
              //     return ret_val;
              //
              // }
          },
          watch : {

              currency_code : function(new_val)
              {
                  if (typeof currencies[new_val] !== 'undefined')
                      this.currency_symbol = currencies[new_val.toUpperCase()];
                  else
                      this.currency_symbol = '$';

                  if(new_val.toUpperCase() != new_val)
                      this.currency_code = new_val.toUpperCase();
              },
              expense_foreign : function(new_val)
              {
                  app.helperPositiveFloat(new_val, "expense_foreign");
              },

              exchange_rate : function(new_val)
              {
                  app.helperPositiveFloat(new_val, "exchange_rate");
              },

              value : function(new_val)
              {
                  app.helperPositiveFloat(new_val, "value");
              },

              tax : function(new_val){
                  app.helperPositiveFloat(new_val, "tax");
              },

              date_issued : function(new_val){
                  this.date1 = new_val;
              },
          },

          methods: {

              test : function(){
                  console.log("C: " + '#'+ this.containers[0].container_num);
                  $('#'+ this.containers[0].container_num).boxWidget('collapse');
              },

              add_container : function(){

                  var container = {
                      "container_num" : this.container_num,
                      "contents" : [],
                      "collapse" : false,
                  };

                  this.containers.push(container);

                  //
                  // this.containers.forEach(function(value, index){
                  //     console.log("value");
                  //     console.log(value.container_num);
                  //     console.log(app.container_num);
                  //     if(value.container_num == app.container_num)
                  //         app.selected_container = index;
                  //
                  //     $('#'+value.container_num).boxWidget({
                  //         animationSpeed: 500,
                  //         collapseTrigger: '#'+value.container_num +'_close',
                  //         // removeTrigger: '#my-remove-button-trigger',
                  //         collapseIcon: 'fa-minus',
                  //         expandIcon: 'fa-plus',
                  //         // removeIcon: 'fa-times'
                  //     });
                  // });

                  this.container_num = null;
                  this.container_step = 0;
              },

              select_container : function(index){

                  this.selected_container = index;
                  if(!this.containers[index].collapse)
                  {
                          $('#'+ this.containers[index].container_num).boxWidget({
                              animationSpeed: 500,
                              collapseTrigger: '#'+this.containers[index].container_num +'_close',
                              // removeTrigger: '#my-remove-button-trigger',
                              collapseIcon: 'fa-minus',
                              expandIcon: 'fa-plus',
                              // removeIcon: 'fa-times'
                          });

                          this.containers[index].collapse = true;
                  }

              },



              dismiss_warning : function(){
                  this.is_alert = false;

              },
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

              },

              copyDates : function(){
                  this.copyDate(1);
              },

              validate : function(){

                  var errors = [];

                  switch (this.showForm)
                  {
                      case 0 :
                          break;

                      case 1:
                          break;
                  }

                  if( Object.entries(errors).length) // because errors is an obj and does not have length
                      return { status : 'error', 'errors' : errors };
                  return {status : 'success'};
              },

              submit : function(){

                  this.is_alert = false;
                  this.errors = [];

                  var validate = this.validate();

                  if(validate.status == 'success')
                      this.toggle(true);

                  else if(validate.errors)//errors
                      this.errors = validate.errors;

              },

              save : function(){

                  $.post("{{route('lcs.store')}}",
                      {
                          "_token" : "{{csrf_token()}}",

                          "lc_num" : this.lc_num,
                          "invoice_num" : this.invoice_num ,
                          "date_issued" : this.date_issued ,
                          "date_expired" : this.date_expired,
                          "applicant" : this.applicant,
                          "beneficiary" : this.beneficiary,
                          "departing_port" : this.departing_port,
                          "arriving_port" : this.arriving_port,
                          "currency_code" : this.currency_code,
                          "exchange_rate" : this.exchange_rate,
                          "lc_value" : this.lc_value,
                          "expense_foreign" : this.expense_foreign ? this.expense_foreign : 0,
                          "expense_local" : this.expense_local  ? this.expense_local : 0,
                          "notes" : this.notes,

                          "proforma_invoice": this.proforma_invoice
                      } ,
                      function(data)
                      {
                          if(data.status == 'success')
                              app.is_complete = true;
                      });

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

                  this.errors = [];
                  this.is_alert = false;
                  if(this.showForm==0)
                  {
                      this.date_flag = false;
                      this.copyDates();

                  }
                  else
                  {
                      this.date_flag = true;

                      this.date1 = this.date_issued;
                  }


                  this.direction = direction;

                  if(direction)
                      (this.showForm  == 2) ? this.save() : this.showForm++;
                  else
                      (this.showForm  == 0) ? this.showForm = 2 : this.showForm--;

                  window.scrollTo(0,0);

              },

              tyreCatalog : function(){

                  this.showCatalog = !this.showCatalog;
              },

              addTyre : function(id){
                  for(var i=0; i<this.tyre_catalog.length; i++)
                  {
                      if(tyre_catalog[i].tyre_id == id)
                      {
                          var obj = Object.assign ({}, tyre_catalog[i]);

                          this.containers[this.selected_container].contents.push(obj);
                          break;
                      }
                  }
              },

              removeTyre : function(container_index, tyre_index){


                  this.containers[container_index].contents = this.containers[container_index].contents.filter(function(value, i, array){
                      // all items except for the current index
                      return tyre_index != i;
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
          }

      })
  </script>
@endsection