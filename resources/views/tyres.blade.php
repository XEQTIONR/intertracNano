@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootsreap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Tyre Catalog  <small>Complete list of tyres.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @include('partials.tables.tyres')
    </div>
  </div>

</div>
@endsection
