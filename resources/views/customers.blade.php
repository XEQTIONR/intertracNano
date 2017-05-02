@extends('layout')

@section('content')

<table>
  <tr>
    <th>customer#</th>
    <th>tyre_brand</th>
    <th>tyre_size</th>
    <th>tyre_pattern</th>
  </tr>


  @foreach ($tyres as $tyre)
    <tr>
    <td>{{$tyre->id}}</td>
    <td>{{$tyre->tyre_brand}}</td>
    <td>{{$tyre->tyre_size}}</td>
    <td>{{$tyre->tyre_pattern}}</td>
  </tr>
  @endforeach



</table>

@endsection
