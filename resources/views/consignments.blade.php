@extends('layout')

@section('scripts')


@endsection

@section('content')

<a href="/consignment_containers">View Consignment Info</a>
<table class="DBinfo">
  <tr>
    <th>BOL#</th>
    <th>Value$</th>
    <th>Tax</th>
    <th>Land Date</th>
    <th>LC#</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($consignments as $consignment)
  <tr>
    <td>{{$consignment->BOL}}</td>
    <td>{{$consignment->value}}</td>
    <td>{{$consignment->tax}}</td>
    <td>{{$consignment->land_date}}</td>
    <td>{{$consignment->lc}}</td>
    <td>{{$consignment->created_at}}</td>
    <td>{{$consignment->updated_at}}</td>
    <td><a href="/container_contents/{{$consignment->BOL}}" >View Contents</a></td>
  </tr>
  @endforeach



</table>

@endsection
