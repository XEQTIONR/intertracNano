@extends('layout')

@section('content')

<table class="DBinfo">
  <tr>
    <th>customer#</th>
    <th>Customer Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Notes</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($customers as $customer)
  <tr>
    <td>{{$customer->id}}</td>
    <td>{{$customer->name}}</td>
    <td>{{$customer->address}}</td>
    <td>{{$customer->phone}}</td>
    <td>{{$customer->notes}}</td>
    <td>{{$customer->created_at}}</td>
    <td>{{$customer->updated_at}}</td>
  </tr>
  @endforeach



</table>

@endsection
