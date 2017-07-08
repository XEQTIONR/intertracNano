@extends('layout.mainlayout')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>New Customer <small>Add a new customer who can order from us.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <form class="form-horizontal" method="post" action="/customers">

        @include('partials.errors')

        <div class="panel panel-default" style="margin-top: 1.6em;">
          <div class="panel-heading">Enter new customer information to add to database.</div>

          <div class="panel-body">
            <div class="row">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName" class="col-md-3 col-md-offset-2 control-label">Customer/Party Name</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="Name" id="inputName" value="{{old('Name')}}">
                </div>
              </div>

              <div class="form-group">
                <label for="inputAddress" class="col-md-3 col-md-offset-2 control-label">Address</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="Address" id="inputAddress" value="{{old('Address')}}">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPhone" class="col-md-3 col-md-offset-2 control-label">Phone#</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="Phone" id="inputPhone" value="{{old('Phone')}}">
                </div>
              </div>

              <div class="form-group">
                <label for="inputNotes" class="col-md-3 col-md-offset-2 control-label">Notes</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="Notes" id="inputNotes" value="{{old('Notes')}}">
                </div>
              </div>
            </div> <!--row-->

            <div class="row">
              <div class="col-md-2 col-md-offset-5">
                <button class="btn btn-primary" type="submit" value="submit">Submit</button>
              </div>
            </div> <!--row-->

          </div> <!--panel-body-->
        </div> <!--panel-->

      </form>
    </div> <!--col-->
  </div> <!--row-->
</div> <!--container-->

@endsection
