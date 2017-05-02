@extends('layout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>customer#</th>
    <th>Customer Name</th>
    <th>Phone</th>
    <th>Notes</th>
  </tr>


  @foreach ($customers as $customer)
    <tr>
    <td>{{$customer->id}}</td>
    <td>{{$customer->name}}</td>
    <td>{{$customer->phone}}</td>
    <td>{{$customer->notes}}</td>
  </tr>
  @endforeach



</table>

@endsection
