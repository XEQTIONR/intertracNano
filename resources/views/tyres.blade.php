@extends('layout.mainlayout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>tyre_id</th>
    <th>Tyre Brand</th>
    <th>Tyre Size</th>
    <th>Tyre Pattern</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($tyres as $tyre)
    <tr>
    <td>{{$tyre->tyre_id}}</td>
    <td>{{$tyre->brand}}</td>
    <td>{{$tyre->size}}</td>
    <td>{{$tyre->pattern}}</td>
    <td>{{$tyre->created_at}}</td>
    <td>{{$tyre->updated_at}}</td>
  </tr>
  @endforeach



</table>

@endsection
