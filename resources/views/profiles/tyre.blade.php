@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootsreap container -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Tyre information</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-push-3">
      <dl class="dl-horizontal">
        <dt>Tyre ID</dt>
        <dd>{{$tyre->tyre_id}}</dd>

        <dt>Brand</dt>
        <dd>{{$tyre->brand}}</dd>

        <dt>Size</dt>
        <dd>{{$tyre->size}}</dd>

        <dt>Pattern</dt>
        <dd>{{$tyre->pattern}}</dd>

        <dt>created_at</dt>
        <dd>{{$tyre->created_at}}</dd>

        <dt>updated_at</dt>
        <dd>{{$tyre->updated_at}}</dd>
      </dl>
    </div>
  </div>

  <div class="row">
  <div class="col-md-1 col-md-push-3">
    <button type="button">Edit</button>
  </div>
</div>
</div>
@endsection
