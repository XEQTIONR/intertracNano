@extends('layouts.app')




@section('title')
  Products
@endsection
@section('subtitle')
  Add a tyre.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Products',
    'subcrumb' => 'Add a tyre',
     'link' => route('tyres.index')])
  @endcomponent
@endsection

@section('body')


<div v-cloak class="row justify-content-center">
  <div class="col-xs-12">
    <transition name="custom-classes-transition"
                enter-active-class="animated fadeIn faster"
                leave-active-class="animated fadeOut faster"
    >
      {{--<div v-if="is_alert" id="alert" class="alert" :class="alert_class" role="alert">--}}
        {{--<button type="button" class="close" aria-label="Close"><span @click="dismiss_warning()" aria-hidden="true">&times;</span></button>--}}
        {{--<h4><i class="icon fa fa-warning"></i> No Proforma Invoice !</h4>--}}
        {{--You have not entered a proforma invoice. It is recommended that you enter proforma invoice information.--}}
        {{--<button @click="toggle(true)" type="button" class="btn btn-warning ml-5">Click here to skip (not recommended)</button>--}}
      {{--</div>--}}
      <div v-if="is_complete" id="alert" class="alert alert-success"  role="alert">
        <button type="button" class="close" aria-label="Close" data-dismiss="alert"><span @click="dismiss_warning()" aria-hidden="true">&times;</span></button>
        <h4><i class="icon fa fa-check-circle"></i> Done</h4>
        New Tyre has been added. You can keep adding new tyres.
      </div>
    </transition>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-xs-12 col-md-8 col-lg-6">
    <div class="box box-default">
      <div class="box-header">
        <h3 class="page-header ml-3"><i class="fas fa-tire mr-3"></i>Add a tyre</h3>
      </div>
      <div class="box-body">
        <form class="form-horizontal" method="post" action="/tyres">
          <div class="box-body m-3">


            {{--<div class="row">--}}
              {{--{{ csrf_field() }}--}}
            <div class="row justify-content-center">
              <div class="col-xs-12">
              <div class="form-group">
                <label for="inputBrand">Brand</label>
                {{--<div class="input-group">--}}
                  <input v-model="brand" type="text" class="form-control" name="Brand" id="inputBrand" value="{{old('Brand')}}" required>
                {{--</div>--}}
              </div>

              <div class="form-group">
                <label for="inputSize">Size Code</label>
                {{--<div class="input-group">--}}
                  <input v-model="size" type="text" class="form-control" name="Size" id="inputSize" value="{{old('Size')}}" required>
                {{--</div>--}}
              </div>

              <div class="form-group">
                <label for="inputLisi">Li/Si</label>
                {{--<div class="input-group">--}}
                  <input v-model="lisi" type="text" class="form-control" name="Lisi" id="inputLisi" value="{{old('Lisi')}}">
                {{--</div>--}}
              </div>

              <div class="form-group">
                <label for="inputPattern">Pattern Code</label>
                {{--<div class="input-group">--}}
                  <input v-model="pattern" type="text" class="form-control" name="Pattern" id="inputPattern" value="{{old('Pattern')}}" required>
                {{--</div>--}}
              </div>
              </div>
            </div>



            {{--</div><!--row-->--}}

            <div class="row">
              <div class="col-xs-12 px-0">
                <button class="btn btn-lg btn-primary pull-right" type="button" @click="save()">Submit</button>
              </div>
            </div>
          </div>
          <!--</div>panel-body-->
          <!--</div> panel-->
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')

<script>
  var app = new Vue({
     el : '#app',
     data : {

         brand        : null,
         size         : null,
         lisi         : null,
         pattern      : null,
         is_complete  : false
     },

     methods : {

         validate : function(){

             return true;
         },

         save : function (){

             if(this.validate())
             {
                 $.post("{{ route('tyres.store')}}",
                     {
                         "_token" : "{{csrf_token()}}",
                         "brand" : this.brand,
                         "size" : this.size,
                         "pattern" : this.pattern,
                         "lisi" : this.lisi
                     },

                     function(data)
                     {
                         console.log(data);
                         if(data.status == 'success')
                         {
                             app.is_complete = true;
                             app.brand = null;
                             app.size = null;
                             app.lisi = null;
                             app.pattern = null;

                             $(window).scrollTop(0);

                             setTimeout(function(){
                                 app.is_complete = false;
                             }, 5000);
                         }

                     }
                 );
             }


         }

     }
  });
</script>
@endsection
