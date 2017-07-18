@extends('layout.mainlayout')


@section('content')
  <div class="container"> <!-- bootsreap container -->

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="page-header">
          <h1>Current Stock  <small>Tyres currently available.</small></h1>
        </div>
      </div>
    </div>

    <div class="row">
      @include('partials.currentstock');
    </div>
  </div>
@endsection
