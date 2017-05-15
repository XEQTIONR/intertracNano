@extends('layout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>Container#</th>
    <th>BOL#</th>
    <th>Tyre ID</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($contents as $content)
    <tr>
      <td>{{$content->Container_num}}</td>
      <td>{{$content->BOL}}</td>
      <td>{{$content->tyre_id}}</td>
      <td>{{$content->qty}}</td>
      <td>{{$content->unit_price}}</td>
      <td>{{$content->created_at}}</td>
      <td>{{$content->updated_at}}</td>
    </tr>
  @endforeach



</table>

@endsection
