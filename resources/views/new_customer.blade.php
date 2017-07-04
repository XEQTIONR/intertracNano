@extends('layout.mainlayout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <form class="form-horizontal" method="post" action="/customers">

        <div class="panel panel-default" style="margin-top: 1.6em;">
          <div class="panel-heading">Enter new customer information to add to database.</div>

          <div class="panel-body">
            <div class="row">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName" class="col-md-3 col-md-offset-2 control-label">Customer/Party Name</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="inputName" id="inputName">
                </div>
              </div>

              <div class="form-group">
                <label for="inputAddress" class="col-md-3 col-md-offset-2 control-label">Address</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="inputAddress" id="inputAddress">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPhone" class="col-md-3 col-md-offset-2 control-label">Phone#</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="inputPhone" id="inputPhone">
                </div>
              </div>

              <div class="form-group">
                <label for="inputNotes" class="col-md-3 col-md-offset-2 control-label">Notes</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="inputNotes" id="inputNotes">
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
