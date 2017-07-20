@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootstrap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Payments <small>List of payments made by customers</small></h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      @include('partials.tables.payments')
    </div>
  </div>
</div>
@endsection
