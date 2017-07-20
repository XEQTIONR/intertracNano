@extends('layout.mainlayout')





@section('content')

<div class="container"> <!-- bootsreap container -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Orders <small>All orders placed by customers.</small></h1>
      </div>
    </div>
  </div>


@include('partials.tables.orders')

</div>

@endsection
