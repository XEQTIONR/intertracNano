@extends('layout.mainlayout')

@section('content')

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<form class="form-horizontal" method="post" action="/tyres">
<div class="panel panel-default" style="margin-top: 1.6em;">
  <div class="panel-heading">Enter new tyre information to add to database.</div>
  <div class="panel-body">


    <div class="row">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="inputBrand" class="col-md-3 col-md-offset-2 control-label">Brand</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="inputBrand" id="inputBrand" required>
        </div>
      </div>

      <div class="form-group">
        <label for="inputSize" class="col-md-3 col-md-offset-2 control-label">Size Code</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="inputSize" id="inputSize" required>
        </div>
      </div>

      <div class="form-group">
        <label for="inputPattern" class="col-md-3 col-md-offset-2 control-label">Pattern Code</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="inputPattern" id="inputPattern" required>
        </div>
      </div>

    </div><!--row-->

    <div class="row">
      <div class="col-md-2 col-md-offset-5">
        <button class="btn btn-primary" type="submit" value="submit">Submit</button>
      </div>
    </div>

</div><!--panel-body-->
</div> <!--panel-->
</form>
</div> <!--col-->
</div><!--row-->
</div><!--container-->


@endsection
