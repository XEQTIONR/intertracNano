@extends('layout.mainlayout')


@section('scripts')
<style>
  .input{
    width : 33%;
  }

  label small{
    color : #999;
    font-weight: lighter;
  }
</style>

  <script src="/js/addItem.js"></script>
  <script src="/js/spinner.js"></script>
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>New Proforma Invoice <small>Enter new LC information.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" method="post" action="/performa_invoices">
        {{ csrf_field() }}
        @include('partials.errors')

        <div class="panel panel-default" style="margin-top: 1.6em;">
          <div class="panel-heading">1. Enter a LC number that already exists in the system without a peroforma invoice</div>
          <div class="panel-body">

            <label for="inputLC" class="col-md-3 col-md-offset-2 control-label">LC#  <small>F20</small></label>
            <div class="col-md-3">
              <input type="text" class="form-control" name="inputLC" id="inputLC" value="{{old('inputLC')}}" required>
            </div>
          </div>
        </div><!--panel-->


                <div class="panel panel-default">
                <div class="panel-heading"> 2. Enter Proforma Invoice Information</div>
                <div class="panel-body">


                <div class="col-md-5">
                  <div id="itemList">
                    <div class="row">
                      <div id="col-md-12">
                        <h4>Enter Proforma Invoice</h4>
                        <span>None of the fields can be blank</span>
                          <!-- Javascript adds fields here-->
                        </div><!--col-->
                      </div><!--row-->
                  </div><!--itemList-->
                  <br>
                  <div class="row">
                    <div class="form-group">
                      <label for="numItems" class="col-md-4 control-label">Num items</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="numItems" id="numItems" placeholder="0" readonly>
                      </div>
                    </div>
                  </div> <!--row-->

                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-default" type="button" onclick="addItem()">Add New Item</button>
                      <button class="btn btn-danger" type="button" onclick="removeItem()">Remove Last Item</button>
                      <button class="btn btn-info" type="submit" value="submit">Submit</button><br><br><br>
                    </div>
                  </div><!--row-->
                </div> <!--col-md-5-->


                <div id=catalogContainer class="col-md-6 col-md-offset-1">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <h4>Tyre Catalog</h4>
                    </div> <!--panel-heading-->

                    <div class="panel-body">
                      <div id="tyreCatalog" class="col-md-12">
                        @include('partials.tyres')
                      </div>
                    </div> <!--panel-body-->
                  </div> <!--panel-->
                </div> <!--catalogContainer-->


            </div> <!--panel-body-->
          </div> <!--panel-->






</form>
</div>
</div>
</div>

{{--<div class="rightDiv">
  <table class="DBinfo">
    <tr>
      <th>tyre_id</th>
      <th>Tyre Brand</th>
      <th>Tyre Size</th>
      <th>Tyre Pattern</th>
      <th>Created</th>
      <th>Updated</th>
    </tr>


    @foreach ($tyres as $tyre)
      <tr>
      <td>{{$tyre->tyre_id}}</td>
      <td>{{$tyre->brand}}</td>
      <td>{{$tyre->size}}</td>
      <td>{{$tyre->pattern}}</td>
      <td>{{$tyre->created_at}}</td>
      <td>{{$tyre->updated_at}}</td>
    </tr>
    @endforeach



  </table>
</div>--}}


@endsection
