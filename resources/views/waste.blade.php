@extends('layouts.app')

@section('title')
  Waste
@endsection
@section('subtitle')
  Waste.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Waste',
    'subcrumb' => 'waste',
    'link' => ''])
  @endcomponent
@endsection

@section('body')

  <div v-cloak class="row" v-for="(consignment,index) in remain">
    <div class="col-xs-12 col-lg-8" v-for="(contents, bol) in consignment">
      <div class="box">
        <div class="box-header">
          <h3><b>BOL# </b>@{{ bol }}</h3>
        </div>
        <div class="box-body">
          <table class="table table-" v-for="(stock,container_num) in contents" style="margin-bottom: 5px !important;">
          <thead>
            <tr>
              <th colspan="4">
                <i class="icon-container-storage-r fa-container-storage mr-3" style="position: relative; top: 3px; font-size : 1.5rem"></i>
                 # : @{{ container_num }}
              </th>
            </tr>
            <tr>
              <th class="col-xs-6">Tyre</th>
              <th class="col-xs-2 text-center">in_stock</th>
              <th class="col-xs-2 text-center">add waste</th>
              <th class="col-xs-2 text-center text-red">Updated Stock</th>
            </tr>
          </thead>
          <tbody>

            <tr v-for="(item, idx) in stock">
              <td class="col-xs-6"><b>(@{{ item.tyre_id }})</b> @{{ item.tyre.brand }} @{{ item.tyre.size }} @{{ item.tyre.pattern }} @{{ item.tyre.lisi }}</td>
              <td class="col-xs-2 text-center">@{{ item.in_stock }}</td>
              <td class="col-xs-2"><input class="text-center"   v-model="remain[index][bol][container_num][idx].ret_amt"> </td>
              <td class="col-xs-2 text-red text-center" v-if="parseInt(remain[index][bol][container_num][idx].ret_amt)!=0">@{{ parseInt(item.in_stock) - parseInt(remain[index][bol][container_num][idx].ret_amt) }} </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td class="col-xs-6 strong">Total</td>
              <td class="col-xs-2 strong text-center">@{{ containerTotal(bol, container_num) }}</td>
              <td class="col-xs-2 strong text-center">@{{ containerWasteTotal(bol, container_num) }}</td>
              <td class="col-xs-2 text-red text-center strong" v-if="parseInt(containerTotal(bol, container_num))!=parseInt(containerTotalAfterReturn(bol, container_num))">@{{ containerTotalAfterReturn(bol, container_num) }}</td>
            </tr>
          </tfoot>
        </table>
        </div>
      </div>
    </div>
{{--      @foreach($remain as $consignment)--}}
{{--        @foreach($consignment as $bol => $containers)--}}
{{--        <h4>{{$bol}}</h4><br>--}}
{{--          <table class="table table-bordered">--}}
{{--            @foreach($containers as $container_num => $contents)--}}
{{--              <tr><td colspan="4"> {{$container_num}}</td></tr>--}}
{{--              <tr>--}}
{{--              @foreach($contents[0] as $key => $val)--}}
{{--                <td>{{$key}}</td>--}}
{{--              @endforeach--}}
{{--              </tr>--}}
{{--              @foreach($contents as $content)--}}
{{--                <tr>--}}
{{--                @foreach($content as $key => $val)--}}
{{--                  <td>{{$val}}</td>--}}
{{--                @endforeach--}}
{{--                </tr>--}}
{{--              @endforeach--}}
{{--            @endforeach--}}
{{--          </table>--}}
{{--        @endforeach--}}
{{--      @endforeach--}}





  </div>


@endsection

@section('footer-scripts')

  <script>
    var remain = JSON.parse('{!! $remain !!}');
    console.log('remain');
    console.log(remain);

    for(var i =0; i<remain.length; i++)
    {
        Object.keys(remain[i]).forEach(function(key){
            Object.keys(remain[i][key]).forEach(function(cont){
                for(var j=0; j<remain[i][key][cont].length; j++){

                    remain[i][key][cont][j].ret_amt = 0;
                }
            });
        });
    }

    var app = new Vue({
        el: '#app',
        data : {
            remain : remain
        },

        watch : {

            remain : {
                deep :true,

                handler : function(new_val){


                    console.log("REMAIN CHANGED");
                    //console.log(new_val);

                    for(var i=0;i<new_val.length; i++){
                        Object.keys(new_val[i]).forEach(function(key){

                            Object.keys(new_val[i][key]).forEach(function(cont){
                                for(var j=0; j<new_val[i][key][cont].length; j++){

                                    if(isNaN(new_val[i][key][cont][j].ret_amt) || new_val[i][key][cont][j].ret_amt==""
                                        || new_val[i][key][cont][j].ret_amt<0
                                        || new_val[i][key][cont][j].ret_amt > parseInt(new_val[i][key][cont][j].in_stock)
                                        || (typeof new_val[i][key][cont][j].ret_amt == "string" && new_val[i][key][cont][j].ret_amt.indexOf(".")!= -1))
                                    {
                                        new_val[i][key][cont][j].ret_amt = 0;
                                    }
                                    else if(typeof new_val[i][key][cont][j].ret_amt == "string" && new_val[i][key][cont][j].ret_amt[0] == "0")
                                    {
                                        new_val[i][key][cont][j].ret_amt = parseInt(new_val[i][key][cont][j].ret_amt);
                                    }
                                    //remain[i][key][cont][j].ret_amt = 0;
                                }
                            });
                        });
                    }
                }
            }
        },

        methods : {
            containerTotal : function(bol, container_num){
                var ret = null;
                for(var i=0; i<this.remain.length; i++)
                {
                    Object.keys(this.remain[i]).forEach(function(key){
                        if(key==bol){
                            Object.keys(this.remain[i][bol]).forEach(function(cont){
                                if(cont==container_num)
                                    for(var j=0; j<this.remain[i][bol][container_num].length; j++){
                                        if(ret ==  null)
                                            ret = 0;
                                        ret += parseInt(this.remain[i][bol][container_num][j].in_stock);
                                    }
                            })
                        }

                    });
                }
                return ret;
            },
            containerTotalAfterReturn : function(bol, container_num){
                var ret = null;
                for(var i=0; i<this.remain.length; i++)
                {
                    Object.keys(this.remain[i]).forEach(function(key){
                        if(key==bol){
                            Object.keys(this.remain[i][bol]).forEach(function(cont){
                                if(cont==container_num)
                                    for(var j=0; j<this.remain[i][bol][container_num].length; j++){
                                        if(ret ==  null)
                                            ret = 0;
                                        ret += (parseInt(this.remain[i][bol][container_num][j].in_stock) - parseInt(this.remain[i][bol][container_num][j].ret_amt));
                                    }
                            })
                        }

                    });
                }
                return ret;
            },
            containerWasteTotal : function(bol, container_num){
                var ret = null;
                for(var i=0; i<this.remain.length; i++)
                {
                    Object.keys(this.remain[i]).forEach(function(key){
                        if(key==bol){
                            Object.keys(this.remain[i][bol]).forEach(function(cont){
                                if(cont==container_num)
                                    for(var j=0; j<this.remain[i][bol][container_num].length; j++){
                                        if(ret ==  null)
                                            ret = 0;
                                        ret += parseInt(this.remain[i][bol][container_num][j].ret_amt);
                                    }
                            })
                        }

                    });
                }
                return ret;
            }
        },
        mounted : function(){

        }
    })
  </script>

@endsection
