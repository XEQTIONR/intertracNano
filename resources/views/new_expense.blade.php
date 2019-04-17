@extends('layouts.app')

@section('title')
  Expenses
@endsection
@section('subtitle')
  Add a new consignment expense.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'expenses',
    'subcrumb' => 'Add an expense',
     'link' => route('consignments.index')])
  @endcomponent
@endsection

@section('body')

  <div v-cloak class="row justify-content-center">
    <div class="col-xs-12">
      <transition name="custom-classes-transition"
                  enter-active-class="animated fadeIn faster"
                  leave-active-class="animated fadeOut faster"
      >
        <div v-if="is_complete" id="alert" class="alert alert-success"  role="alert">
          <button type="button" class="close" aria-label="Close"><span @click="dismiss_warning()" aria-hidden="true">&times;</span></button>
          <h4><i class="icon fa fa-check-circle"></i> Done</h4>
          New container has been saved.
          <a href="{{ route('consignment_containers.index') }}"  class="btn btn-success ml-5">Click here to view all Containers</a>
        </div>
      </transition>
    </div>
  </div>
  <div v-cloak class="row justify-content-center">
    <transition  name="custom-classes-transition"
                 mode="out-in"
                 :enter-active-class="direction? 'animated fadeInRight fast' : 'animated fadeInLeft fast'"
                 :leave-active-class="direction? 'animated fadeOutLeft fast' : 'animated fadeOutRight fast'"
    >
      <div  v-if="showForm == 0" key="0" class="col-xs-12 col-md-10">


        <div class="box box-info">
          <div class="box-header">
            <h3 class="page-header ml-3">
              <i class="far fa-anchor mr-3"></i>
              Select a consignment to add the container to.
            </h3>
          </div>
          <div class="box-body">

            <form class="form">
              <div class="box-body">
                <div class="row mx-2">
                  <div class="col-xs-12">
                    <div class="form-group" :class="{ 'has-error' :  errors.bol }">
                      <label>Bill of Lading #</label>

                      <select id="lc_num" v-model="bol" class="form-control" placeholder="sel ect an LC">
                        <option disabled :value="null">Select a consignment</option>
                        <option  v-for="consignment in consignments" :value="consignment.BOL">@{{consignment.BOL}}</option>
                      </select>

                      <span v-if=" errors.bol" class="help-block">@{{ errors.bol }}</span>
                    </div>
                    <div v-if="consignment_index" class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>LC #</label> <br>
                          <span>  @{{ consignments[consignment_index].lc }}</span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Land date</label> <br>
                          <span>  @{{ consignments[consignment_index].land_date | date }}</span>
                        </div>
                      </div>
                    </div>
                    <div v-if="consignment_index" class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Exchange rate</label> <br>
                          <span> @{{ consignments[consignment_index].exchange_rate}} / ৳ </span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Value</label> <br>
                          <span>@{{ currency_symbol  }} @{{ consignments[consignment_index].value}}</span>
                        </div>
                      </div>
                    </div>
                    <div v-if="consignment_index" class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Total Tax</label> <br>
                          <span> ৳ @{{ consignments[consignment_index].tax}}</span>
                        </div>
                      </div>

                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Value (in TK)</label> <br>
                          <span> ৳ @{{ parseFloat(consignments[consignment_index].value) * parseFloat(consignments[consignment_index].exchange_rate) | currency}}</span>
                        </div>
                      </div>
                    </div>
                    <div v-if="consignment_index" class="row">
                      {{--<div class="col-xs-6">--}}
                        {{--<div class="form-group">--}}
                          {{--<label>Containers</label> <br>--}}
                          {{--<span> @{{ consignments[consignment_index].containers.length}}</span>--}}
                        {{--</div>--}}
                      {{--</div>--}}

                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Total Cost (Value + Tax)</label> <br>
                          <span> ৳
                            @{{ parseFloat(consignments[consignment_index].value)* parseFloat(consignments[consignment_index].exchange_rate) + parseFloat(consignments[consignment_index].tax)| currency}}</span>
                        </div>
                      </div>
                    </div>
                    <div v-if="consignment_index" class="row">
                      <div class="col-xs-12">
                        <table class="table table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>Expense id</th>
                              <th>Expense Notes</th>
                              <th>Expense Foreign</th>
                              <th>Expense Local</th>
                              <th>created_at</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="" v-for="expense in consignments[consignment_index].expenses">
                              <td>@{{ expense.expense_id }}</td>
                              <td>@{{ expense.expense_notes }}</td>
                              <td>@{{ expense.expense_foreign | currency }}</td>
                              <td>@{{ expense.expense_local | currency }}</td>
                              <td>@{{ expense.created_at }}</td>
                            </tr>
                            <tr class="info" v-for="(expense, index) in new_expenses" style="max-height : 75px;">
                              <td class="pt-4 pb-0"><span class="label bg-blue">NEW</span></td>
                              <td>@{{ expense.expense_notes }}</td>
                              <td>@{{ expense.expense_foreign | currency }}</td>
                              <td>@{{ expense.expense_local | currency }}</td>
                              <td>
                                <i @click="remove_expense(index)" class="fas fa-minus-circle"></i>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>


                    <div v-if="consignment_index" class="row justify-content-center">
                      <div class="col-xs-12 col-md-4">
                        <div class="form-group" :class="{ 'has-error' :  errors.expense }">
                          <label class="mr-5">Expense Foreign</label>
                          <div class="input-group">
                            <span class="input-group-addon">@{{ currency_symbol }}</span>
                            <input class="w-100" v-model="expense_foreign" type="number">
                          </div>
                          <span v-if=" errors.expense" class="help-block text-danger">@{{ errors.expense }}</span>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4 d-flex justify-content-center align-items-center">
                        {{--<div class="form-group">--}}
                          <span class="text-center d-block text-gray">and / or</span>
                          {{--<div class="input-group">--}}
                          {{--<input type="number">--}}
                          {{--</div>--}}
                        {{--</div>--}}
                      </div>
                      <div class="col-xs-12 col-md-4">
                        <div class="form-group" :class="{ 'has-error' :  errors.expense }">
                          <label class="mr-5">Expense Local</label>
                          <div class="input-group">
                            <span class="input-group-addon">৳</span>
                            <input class="w-100" v-model="expense_local" type="number">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-if="consignment_index" class="row">
                      <div class="col-xs-12 col-md-4 col-md-offset-8">
                        <div class="form-group w-100">
                          <label>Expense Total</label>
                          <div class="input-group w-100">
                            <span>@{{ expense_total | currency }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-if="bol" class="row justify-content-center">
                      <div class="col-xs-12">
                        <div class="form-group w-100" :class="{ 'has-error' :  errors.expense_notes }">
                          <label>Note/Description</label>
                          <div class="input-group w-100">
                          <textarea v-model="expense_notes" class="w-100" rows="7"></textarea>
                          </div>
                          <span v-if=" errors.expense_notes" class="help-block text-danger">@{{ errors.expense_notes }}</span>
                        </div>
                      </div>
                    </div>
                    <div v-if="bol" class="row justify-content-center">
                      <div class="col-xs-12">
                        <button type="button" @click="add_expense()" class="btn btn-block btn-primary">Add Expense</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div v-if="new_expenses.length" class="row mx-2 mt-5">
                  <div class="col-xs-12">
                    <button type="button" class="btn btn-success pull-right" @click="save()">
                      <i class="fas fa-check mr-3"></i>
                      Save
                    </button>
                  </div>
                </div>

              </div>
            </form>


          </div>

        </div>
      </div>

      {{--<div  v-if="showForm == 1" key="1"  class="col-xs-7">--}}
        {{--<div class="box box-info">--}}
          {{--<div class="box-header">--}}
            {{--<h3 class="page-header ml-3">--}}
              {{--<i class="far fa-container-storage mr-3"></i>--}}
              {{--Add more containers to this consignment.--}}
            {{--</h3>--}}
          {{--</div>--}}
          {{--<div class="box-body pb-5 px-5">--}}




            {{--<form style="padding: 1rem;">--}}

              {{--<div class="row mb-2">--}}
                {{--<span class="label bg-gray text-uppercase">Previous containers</span>--}}
              {{--</div>--}}
              {{--<div v-if="consignment_index != null" v-for="(container, index) in consignments[consignment_index].containers" key="container.container_num" class="row" --}}{{--:Class="{'border-dash' : selected_container == index}"--}}{{--  style="flex-direction: column">--}}
                {{--<div class="box box-solid box-default" :id="container.Container_num" @click="makeCollapsible(container.Container_num)" --}}{{--:class="[selected_container == index ? 'box-warning' : 'box-default']"--}}{{-->--}}

                  {{--<div class="box-header">--}}
                    {{--<h4 class="box-title"><i class="far fa-container-storage mr-3"></i> # @{{ container.Container_num }}</h4>--}}
                    {{--<div class="box-tools pull-right">--}}
                      {{--<button type="button"  class="btn btn-box-tool"><i class="fa fa-minus" :id="container.Container_num + '_close'" ></i></button>--}}
                    {{--</div>--}}
                  {{--</div>--}}

                  {{--<div class="box-body px-0 pb-0">--}}
                    {{--<div class="col-xs-12" style="min-height: 100px">--}}
                      {{--<div class="row list-item pb-1">--}}
                        {{--<div class="col-xs-1 text-center"><strong>#</strong></div>--}}
                        {{--<div class="col-xs-2 text-center"><strong>Tyre</strong></div>--}}
                        {{--<div class="col-xs-2 text-center"><strong>Qty</strong></div>--}}
                        {{--<div  class="col-xs-2 text-right"><strong>Unit Price</strong></div>--}}
                        {{--<div class="col-xs-2 text-center"><strong>Total Weight (kg)</strong></div>--}}
                        {{--<div class="col-xs-2 text-center"><strong>Total Tax (৳)</strong></div>--}}
                        {{--<div  class="col-xs-1 text-right"><strong>Sub Total</strong></div>--}}
                        {{--<div  class="col-xs-1 text-right"></div>--}}
                      {{--</div>--}}
                      {{--<transition-group  name="custom-classes-transition"--}}
                                         {{--enter-active-class="animated fadeInDown"--}}
                                         {{--leave-active-class="animated fadeOutUp fast "--}}
                      {{-->--}}
                        {{--<div v-for="(item, item_index) in container.contents" key="item_index"  class="row py-2" :class="{'bg-light-gray' : !(item_index%2)}">--}}
                          {{--<div class="col-xs-1 text-center"><strong>@{{ item_index + 1 }}</strong></div>--}}
                          {{--<div class="col-xs-2 text-center">@{{item.tyre.brand}} @{{item.tyre.size}} @{{ item.tyre.lisi }} @{{item.tyre.pattern}}</div>--}}
                          {{--<div class="col-xs-2 text-center">--}}
                            {{--<div class="form-group"  :class="{ 'has-error' :  errors.qty && parseInt(item.qty)<=0 }">--}}
                              {{--<input class="form-control" v-model="item.qty" disabled type="number" min="0" step="1">--}}
                            {{--</div>--}}
                          {{--</div>--}}
                          {{--<div class="col-xs-2 text-center">--}}
                            {{--<div class="form-group" :class="{ 'has-error' :  errors.unit_price && parseFloat(item.unit_price)<=0 }">--}}
                              {{--<input class="form-control" v-model="item.unit_price" disabled type="number" min="0" step="0.01">--}}
                            {{--</div>--}}
                          {{--</div>--}}
                          {{--<div class="col-xs-2 text-center">--}}
                            {{--<div class="form-group">--}}
                              {{--<input class="form-control" v-model="item.total_weight" disabled type="number" min="0" step="0.01">--}}
                            {{--</div>--}}
                          {{--</div>--}}
                          {{--<div  class="col-xs-2 text-right">--}}
                            {{--<div class="form-group">--}}
                              {{--<input class="form-control" v-model="item.total_tax" disabled type="number" min="0" step="0.01">--}}
                            {{--</div>--}}
                          {{--</div>--}}
                          {{--<div  class="col-xs-1 text-right">@{{item.unit_price * item.qty | currency }}</div>--}}
                          {{--<div class="col-xs-1">--}}
                          {{--</div>--}}
                        {{--</div>--}}
                      {{--</transition-group>--}}

                    {{--</div>--}}

                  {{--</div>--}}

                  {{--<div class="box-footer" >--}}
                    {{--<div class="row justify-content-center">--}}
                      {{--<div class="col-xs-3">--}}
                        {{--<b>Container Totals</b>--}}
                      {{--</div>--}}
                      {{--<div class="col-xs-2 pl-3">--}}
                        {{--@{{ container_total_qty_previous(index) }}--}}
                      {{--</div>--}}
                      {{--<div class="col-xs-1 mr-5"></div>--}}
                      {{--<div class="col-xs-2">--}}
                        {{--@{{ container_total_weight_previous(index) }}--}}
                      {{--</div>--}}
                      {{--<div class="col-xs-2 pr-0">--}}
                        {{--@{{ container_total_tax_previous(index) | currency }}--}}
                      {{--</div>--}}

                      {{--<div class="col-xs-1 px-0">--}}
                        {{--@{{ container_total_value_previous(index) | currency }}--}}
                      {{--</div>--}}
                    {{--</div>--}}
                  {{--</div>--}}

                {{--</div>--}}
              {{--</div>--}}
              {{--<div  class="row">--}}
                {{--<div class="col-xs-3 px-5">--}}
                  {{--<b>Grand Total (Previous)</b>--}}
                {{--</div>--}}
                {{--<div class="col-xs-2 pl-5 pr-0">--}}
                  {{--<b> @{{ total_qty_previous }}</b>--}}

                {{--</div>--}}
                {{--<div class="col-xs-2">--}}
                {{--</div>--}}
                {{--<div class="col-xs-2 pr-2">--}}
                  {{--<b> @{{ total_weight_previous }}</b>--}}

                {{--</div>--}}

                {{--<div class="col-xs-2 pl-4-5">--}}
                  {{--<b>  @{{ total_tax_previous | currency }}</b>--}}

                {{--</div>--}}

                {{--<div class="col-xs-2 pl-3">--}}
                  {{--<b>  @{{ grand_total_foreign_previous | currency }}   </b>--}}
                {{--</div>--}}
              {{--</div>--}}

              {{--<div class="form-group mt-5" :class="{ 'has-error' :  Object.entries(errors).length }">--}}
                {{--<ul>--}}
                  {{--<li class="help-block" v-for="error in errors">@{{ error }}</li>--}}
                {{--</ul>--}}
              {{--</div>--}}

              {{--<div v-if="containers.length" class="row mb-2 mt-5">--}}
                {{--<span class="label label-info text-uppercase">New containers</span>--}}
              {{--</div>--}}
              {{--<transition-group  name="custom-classes-transition"--}}
                                 {{--enter-active-class="animated fadeInDown"--}}
                                 {{--leave-active-class="animated fadeOut fast "--}}
              {{-->--}}



                {{--<div v-for="(container, index) in containers" key="container.container_num" @click="select_container(index)" class="row" --}}{{--:Class="{'border-dash' : selected_container == index}"--}}{{--  style="flex-direction: column">--}}
                  {{--<div class="box box-solid" :id="container.container_num" :class="[selected_container == index ? 'box-info' : 'box-default']">--}}

                    {{--<div class="box-header">--}}
                      {{--<h4 class="box-title"><i class="far fa-container-storage mr-3"></i> # @{{ container.container_num }}</h4>--}}
                      {{--<div class="box-tools pull-right">--}}
                        {{--<button type="button" class="btn btn-box-tool" :id="container.container_num + '_close'"><i class="fa fa-minus"></i></button>--}}
                        {{--<button @click="remove_container(index)" type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>--}}
                      {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="box-body px-0 pb-0">--}}
                      {{--<button type="button" @click="test()" class="btn btn-primary">Click me</button>--}}
                      {{--<div class="col-xs-12" style="min-height: 100px">--}}
                        {{--<div class="row list-item pb-1">--}}
                          {{--<div class="col-xs-1 text-center"><strong>#</strong></div>--}}
                          {{--<div class="col-xs-2 text-center"><strong>Tyre</strong></div>--}}
                          {{--<div class="col-xs-2 text-center"><strong>Qty</strong></div>--}}
                          {{--<div  class="col-xs-2 text-right"><strong>Unit Price</strong></div>--}}
                          {{--<div class="col-xs-2 text-center"><strong>Total Weight (kg)</strong></div>--}}
                          {{--<div class="col-xs-2 text-center"><strong>Total Tax (৳)</strong></div>--}}
                          {{--<div  class="col-xs-1 text-right"><strong>Sub Total</strong></div>--}}
                          {{--<div  class="col-xs-1 text-right"></div>--}}
                        {{--</div>--}}
                        {{--<transition-group  name="custom-classes-transition"--}}
                                           {{--enter-active-class="animated fadeInDown"--}}
                                           {{--leave-active-class="animated fadeOutUp fast "--}}
                        {{-->--}}
                          {{--<div v-for="(item, item_index) in container.contents" key="index"  class="row py-2" :class="{'bg-light-gray' : !(item_index%2)}">--}}
                            {{--<div class="col-xs-1 text-center"><strong>@{{ item_index + 1 }}</strong></div>--}}
                            {{--<div class="col-xs-2 text-center">@{{item.brand}} @{{item.size}} @{{ item.lisi }} @{{item.pattern}}</div>--}}
                            {{--<div class="col-xs-2 text-center">--}}
                              {{--<div class="form-group"  :class="{ 'has-error' :  errors.qty && parseInt(item.qty)<=0 }">--}}
                                {{--<input class="form-control" v-model="item.qty" type="number" min="0" step="1">--}}
                              {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 text-center">--}}
                              {{--<div class="form-group" :class="{ 'has-error' :  errors.unit_price && parseFloat(item.unit_price)<=0 }">--}}
                                {{--<input class="form-control" v-model="item.unit_price" type="number" min="0" step="0.01">--}}
                              {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-2 text-center">--}}
                              {{--<div class="form-group">--}}
                                {{--<input class="form-control" v-model="item.total_weight" type="number" min="0" step="0.01">--}}
                              {{--</div>--}}
                            {{--</div>--}}
                            {{--<div  class="col-xs-2 text-right">--}}
                              {{--<div class="form-group">--}}
                                {{--<input class="form-control" v-model="item.total_tax" type="number" min="0" step="0.01">--}}
                              {{--</div>--}}
                            {{--</div>--}}
                            {{--<div  class="col-xs-1 text-right">@{{item.unit_price * item.qty | currency }}</div>--}}
                            {{--<div class="col-xs-1">--}}
                              {{--<a class="text-danger" @click="removeTyre(index, item_index)">--}}
                                {{--<i class="fas fa-minus-circle mt-1"></i>--}}
                              {{--</a>--}}
                            {{--</div>--}}
                          {{--</div>--}}
                        {{--</transition-group>--}}

                      {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="box-footer" >--}}
                      {{--<div class="row justify-content-center">--}}
                        {{--<div class="col-xs-3">--}}
                          {{--<b>Container Totals</b>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-2 pl-3">--}}
                          {{--@{{ container_total_qty(index) }}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-1 mr-5"></div>--}}
                        {{--<div class="col-xs-2">--}}
                          {{--@{{ container_total_weight(index) }}--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-2 pr-0">--}}
                          {{--@{{ container_total_tax(index) | currency }}--}}
                        {{--</div>--}}

                        {{--<div class="col-xs-1 px-0">--}}
                          {{--@{{ container_total_value(index) | currency }}--}}
                        {{--</div>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                  {{--</div>--}}
                {{--</div>--}}
              {{--</transition-group>--}}
              {{--<div v-if="containers.length" class="row">--}}
                {{--<div class="col-xs-3 px-5">--}}
                  {{--<b>Grand Total</b>--}}
                {{--</div>--}}
                {{--<div class="col-xs-2 pl-5 pr-0">--}}
                  {{--<b> @{{ total_qty }}</b>--}}

                {{--</div>--}}
                {{--<div class="col-xs-2">--}}
                {{--</div>--}}
                {{--<div class="col-xs-2 pr-2">--}}
                  {{--<b> @{{ total_weight }}</b>--}}

                {{--</div>--}}

                {{--<div class="col-xs-2 pl-4-5">--}}
                  {{--<b>  @{{ total_tax | currency }}</b>--}}

                {{--</div>--}}

                {{--<div class="col-xs-2 pl-3">--}}
                  {{--<b>  @{{ total_value | currency }}   </b>--}}
                {{--</div>--}}
              {{--</div>--}}


            {{--</form>--}}



          {{--</div>--}}
          {{--<div class="box-footer px-4">--}}


            {{--<div class="my-4 btn btn-success btn-block">--}}
              {{--<transition  name="custom-classes-transition"--}}
                           {{--mode="out-in"--}}
                           {{--enter-active-class="animated fadeIn fast"--}}
                           {{--leave-active-class="animated fadeOutRight fast "--}}
              {{-->--}}
                {{--<div v-if="container_step==0" key="0" @click="container_step=1" class="row justify-content-center align-items-center p-5">--}}
                  {{--<span class="mr-2" style="font-size: 10px"><i class="fas fa-plus"></i></span>--}}
                  {{--<i style="font-size: 20px;" class="far fa-container-storage mr-3"></i>--}}
                  {{--<span style="font-size : 15px;"><b> Add a container</b></span>--}}
                {{--</div>--}}
                {{--<div v-if="container_step==1" key="1" class="row justify-content-center align-items-center p-5 ">--}}

                  {{--<i style="font-size: 20px;" class="far fa-container-storage mr-3"></i>--}}
                  {{--<span style="font-size : 15px;"><b>#</b></span>--}}
                  {{--<input v-model="container_num" type="text" class="ml-3" placeholder="Enter Container Number">--}}
                  {{--<button @click="add_container()" type="button" class="btn btn-success ml-2">Add</button>--}}
                  {{--<button @click="cancel()" type="button" class="btn btn-warning mr-2">Cancel</button>--}}
                {{--</div>--}}
              {{--</transition>--}}
            {{--</div>--}}

            {{--<button type="button" class="btn btn-default" @click="toggle(false)">--}}
              {{--<i class="fa fa-chevron-left pt-1 mr-2"></i>--}}
              {{--Back--}}
            {{--</button>--}}
            {{--<button type="button" class="btn btn-info pull-right" @click="submit()">--}}
              {{--Continue--}}
              {{--<i class="fa fa-chevron-right pt-1 ml-2"></i>--}}
            {{--</button>--}}
          {{--</div>--}}
        {{--</div>--}}


      {{--</div>--}}

      <div v-if="showForm == 2" key="2" class="col-xs-12">
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fas fa-check mr-3 text-success"></i>Confirm new container information
                <small class="pull-right">Date: 2/10/2014</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">

            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
              <b>Bill of lading # @{{ bol }}</b><br>
              <br>
              <b>LC # </b> @{{ lc_num }}<br>
              <b>Land Date : </b> @{{ date_landed | date }}<br>
            </div>

            <div class="col-sm-6 invoice-col">
              <b>Exchange Rate :</b> ৳ @{{ exchange_rate }} / @{{ currency_symbol }}<br>
              <br>
              <b>Consignment Value : </b>@{{ currency_symbol }} @{{ value | currency }}<br>
              <b>Value in local currency</b> ৳ @{{ value * exchange_rate | currency }}<br>
            </div>

          </div>
          <div class="row mt-5">
            <span class="label bg-gray ml-4 text-uppercase">Existing containers</span>
          </div>
          <div v-for="(container, container_index) in consignments[consignment_index].containers" class="row mt-4">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th colspan="5">
                    <i class="far fa-container-storage mr-2"></i>
                    <span class="">#</span>
                    @{{ container.Container_num }}
                  </th>
                </tr>
                <tr>
                  <th>#</th>
                  <th>Tyre</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total Weight</th>
                  <th>Total Tax</th>
                  <th>Sub-total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(record, index) in container.contents">
                  <td>@{{ index + 1 }}</td>
                  <td>@{{ record.tyre.brand }} @{{ record.tyre.size }} @{{ record.tyre.lisi }} @{{ record.tyre.pattern }}</td>
                  <td>@{{ record.qty }}</td>
                  <td>@{{ currency_symbol }} @{{ record.unit_price | currency }}</td>
                  <td>@{{ record.total_weight }}</td>
                  <td>৳ @{{ record.total_tax | currency }}</td>
                  <td>@{{ currency_symbol }} @{{ record.qty*record.unit_price | currency }}</td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>Container Total</b></td>
                  <td><b>@{{ container_total_qty_previous(container_index) }}</b></td>
                  <td></td>
                  <td><b>@{{ container_total_weight_previous(container_index) }}</b></td>
                  <td><b>৳ @{{ container_total_tax_previous(container_index) | currency}}</b></td>
                  <td><b>@{{ currency_symbol }} @{{ container_total_value_previous(container_index) | currency }}</b></td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <span class="label label-info ml-4 text-uppercase">New containers</span>
          </div>
          <div v-for="(container, container_index) in containers" class="row mt-4">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th colspan="5">
                    <i class="far fa-container-storage mr-2 text-info"></i>
                    <span class="text-info">#</span>
                    <span class="text-info">@{{ container.container_num }}</span>
                  </th>
                </tr>
                <tr>
                  <th>#</th>
                  <th>Tyre</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total Weight</th>
                  <th>Total Tax</th>
                  <th>Sub-total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(record, index) in container.contents">
                  <td>@{{ index + 1 }}</td>
                  <td>@{{ record.brand }} @{{ record.size }} @{{ record.lisi }} @{{ record.pattern }}</td>
                  <td>@{{ record.qty }}</td>
                  <td>@{{ currency_symbol }} @{{ record.unit_price | currency }}</td>
                  <td>@{{ record.total_weight }}</td>
                  <td>৳ @{{ record.total_tax | currency }}</td>
                  <td>@{{ currency_symbol }} @{{ record.qty*record.unit_price | currency }}</td>
                </tr>

                <tr>
                  <td></td>
                  <td><b>Container Total</b></td>
                  <td><b>@{{ container_total_qty(container_index) }}</b></td>
                  <td></td>
                  <td><b>@{{ container_total_weight(container_index) }}</b></td>
                  <td><b>৳ @{{ container_total_tax(container_index) | currency}}</b></td>
                  <td><b>@{{ currency_symbol }} @{{ container_total_value(container_index) | currency }}</b></td>
                </tr>


                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row mt-3">
            <div class="col-xs-6">
              <div class="row">
                <p class="lead ml-5">Actual Values</p>
              </div>
              <div class="row invoice-info well ml-1 mr-1 mb-4">
                <div class="col-sm-6 invoice-col">
                  <b>Foreign Currency Code:</b> <br>
                  @{{ currency_code }}<br>
                  <br>
                  <b>Exchange Rate:</b> <br>
                  ৳ @{{ exchange_rate | currency }} / @{{ currency_symbol }}
                  <br>
                  <br>
                  <b>Tax Paid :</b> <br>
                  ৳ @{{ tax | currency }}
                  {{--<b>Arriving Port:</b> @{{ arriving_port }}<br>--}}

                </div>

                <div class="col-sm-6 invoice-col">
                  <b>Consignment Value: </b><br>
                  @{{ currency_symbol }} @{{ value | currency }}<br>
                  <br>
                  <b>Value in Taka </b><br>
                  ৳ @{{ parseFloat(value)*parseFloat(exchange_rate) | currency }}<br>
                  <br>
                  <b>Total Cost (Value + Tax)</b><br>
                  ৳ @{{ (parseFloat(value)*parseFloat(exchange_rate)) + parseFloat(tax) | currency }}<br>
                  {{--<b>LC Value in Taka: </b> ৳ @{{ lc_value*exchange_rate | currency }}<br>--}}

                </div>

                <!-- /.col -->
              </div>
            </div>
            <div class="col-xs-6">
              <p class="lead">Estimated Values</p>

              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Grand Total (Calculated)</th>
                    <td>@{{ currency_symbol }} @{{ grand_total_foreign | currency }}</td>
                  </tr>
                  <tr>
                    <th>Grand Total in TK (Calculated)</th>
                    <td>৳ @{{ grand_total_foreign*parseFloat(exchange_rate) | currency }}</td>
                  </tr>
                  <tr>
                    <th>Total Tax in TK (Calulated)</th>
                    <td>৳ @{{ total_tax | currency }}</td>
                  </tr>
                  <tr>
                    <th>Total Weight</th>
                    <td>@{{ total_weight }} kg</td>
                  </tr>
                  <tr>
                    <th># of Tyres</th>
                    <td>@{{ total_count }} pcs.</td>
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
  </div>

@endsection

@section('footer-scripts')

  <script>

      $(window).scroll(function(){
          // console.log($(window).scrollTop());

          var top = (parseFloat($(window).scrollTop()) -100 );

          $('#catalogContainer').css('top', top>0 ? top : 0);
      });






      var app = new Vue({
          el: '#app',
          data: {
              showForm : 0,
              showCatalog : false,


              lcs : null,
              lc_num : null,
              bol: null,

              consignment_index : null,
              consignments : JSON.parse('{!! json_encode($consignments) !!}'),

              tax : null,
              date_landed : null,
              date_expired : null,
              currency_code : null,
              exchange_rate : null,
              value : null,
              expense_foreign : null,
              expense_local : null,
              expense_notes : null,
              new_expenses : [],

              proforma_invoice : [],

              containers : [],
              container_step : 0,
              container_num : null,
              selected_container : null,

              direction : true,

              date_flag: false,
              date1: null,
              currency_symbol: '$',

              errors : {},
              is_alert : false,
              is_complete : false,
              is_duplicate : false,

              is_verifying : false,

              alert_class : 'alert-warning',



          },
          computed:{
              expense_total : function(){

                  var ret_val = 0;

                  if(parseInt(this.exchange_rate)>0 && parseFloat(this.expense_foreign)>0)
                      ret_val += parseInt(this.exchange_rate) * parseFloat(this.expense_foreign)

                  if(parseFloat(this.expense_local)>0)
                      ret_val += parseFloat(this.expense_local);

                  return ret_val


              },
          },
          watch : {

              bol : function(new_val){

                  if(new_val != null)
                  {
                      this.consignments.forEach(function(a_consignment, index){

                          if(a_consignment.BOL == new_val)
                          {
                              app.consignment_index = index;
                              app.lc_num = a_consignment.lc;
                              app.date_landed = a_consignment.land_date;
                              app.exchange_rate = parseFloat(a_consignment.exchange_rate);
                              app.value = parseFloat(a_consignment.value);
                              app.tax = parseFloat(a_consignment.tax);
                          }

                      });

                      this.errors = [];
                  }

              },

              currency_code : function(new_val)
              {
                  if (typeof currencies[new_val] !== 'undefined')
                      this.currency_symbol = currencies[new_val.toUpperCase()];
                  else
                      this.currency_symbol = '$';

                  if(new_val.toUpperCase() != new_val)
                      this.currency_code = new_val.toUpperCase();
              },
          },

          methods: {

              add_expense : function(){

                  this.errors = {};

                  var validate = this.validate();

                  if(validate.status == 'success')
                  {
                      var expense = {
                          expense_local : this.expense_local,
                          expense_foreign : this.expense_foreign,
                          expense_notes : this.expense_notes
                      };

                      this.new_expenses.push(expense);

                      this.expense_local = 0;
                      this.expense_foreign = 0;
                      this.expense_notes = null;
                  }
                  else
                  {
                      console.log('this.errors');
                      this.errors = validate.errors;
                  }

              },

              remove_expense : function(index){
                  this.new_expenses.splice(index, 1);
              },

              cancel : function(){
                  this.container_step=0;
                  this.errors = {};
              },


              dismiss_warning : function(){
                  this.is_complete = false;

              },

              copyDate : function(i){

                  if(i==1)
                      this.date_landed = document.getElementById('dateIssued').value;

              },

              copyDates : function(){
                  this.copyDate(1);
              },

              makeCollapsible : function(id){
                  console.log('collapse');
                  $('#'+ id).boxWidget({
                      animationSpeed: 500,
                      collapseTrigger: '#'+id +'_close',
                      // removeTrigger: '#my-remove-button-trigger',
                      collapseIcon: 'fa-minus',
                      expandIcon: 'fa-plus',
                      // removeIcon: 'fa-times'
                  });
              },

              validate : function(){

                  var errors = {};

                  this.expense_local = parseFloat(this.expense_local);
                  this.expense_foreign = parseFloat(this.expense_foreign);
                  console.log('expense_local');
                  console.log(this.expense_local);

                  console.log('expense_foreign');
                  console.log(this.expense_foreign);

                  if(isNaN(this.expense_foreign))
                      this.expense_foreign = 0;

                  if(isNaN(this.expense_local))
                      this.expense_local = 0;

                  if( (this.expense_local <=0)&&(this.expense_foreign<=0) )
                      errors['expense'] = "Add a valid local and/or foreign expense value";

                  if(this.expense_notes == null || this.expense_notes == "")
                      errors['expense_notes'] = "Add a note desribing this expense";

                  if( Object.entries(errors).length)
                      return { status : 'error', 'errors' : errors };

                  return {status : 'success'};
              },

              save : function(){

                  $.post("{{route('consignment_expenses.store')}}",
                      {
                          "_token" : "{{csrf_token()}}",
                          "bol" : this.bol ,
                          "expenses": this.new_expenses
                      } ,
                      function(data)
                      {
                          if(data.status == 'success')
                          {
                              app.is_complete = true;
                              app.consignments[app.consignment_index].expenses = data.expenses;
                              app.new_expenses = [];
                              $(window).scrollTop(0);

                              setTimeout(function(){
                                  app.is_complete = false;
                              }, 5000);
                          }


                      });

              },

              //


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

          mounted : function(){

          }

      })
  </script>
@endsection