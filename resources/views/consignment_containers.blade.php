@extends('layout.mainlayout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>Container#</th>
    <th>BOL#</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($containers as $container)
    <tr>
      <td>{{$container->Container_num}}</td>
      <td>{{$container->BOL}}</td>
      <td>{{$container->created_at}}</td>
      <td>{{$container->updated_at}}</td>
    </tr>
  @endforeach



</table>

@endsection
