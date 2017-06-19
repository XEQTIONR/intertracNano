@extends('layout.mainlayout')

@section('content')

<form method="post" action="/customers">

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


  <button type="submit" value="submit">Submit</button>

</form>

@endsection
