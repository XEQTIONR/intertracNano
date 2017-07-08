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

<table class="table table-hover">
<thead>
  <tr>
    <th>tyre_id</th>
    <th>Tyre Brand</th>
    <th>Tyre Size</th>
    <th>Tyre Pattern</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>


<tbody>
  @foreach ($tyres as $tyre)
    <tr style="cursor: pointer" onclick="location.href='/tyres/{{$tyre->tyre_id}}'">
    <td>{{$tyre->tyre_id}}</td>
    <td>{{$tyre->brand}}</td>
    <td>{{$tyre->size}}</td>
    <td>{{$tyre->pattern}}</td>
    <td>{{$tyre->created_at}}</td>
    <td>{{$tyre->updated_at}}</td>
  </tr>
  @endforeach
</tbody>
</table>

</div>
@endsection
