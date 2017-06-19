@extends('layout.mainlayout')

@section('scripts')


@endsection

@section('content')

<div class="container">
<table class="table table-hover">
<thead>
  <tr>
    <th>BOL#</th>
    <th>Value$</th>
    <th>Tax</th>
    <th>Land Date</th>
    <th>LC#</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>

<tbody>
  @foreach ($consignments as $consignment)
  <tr style="cursor: pointer;" onclick="location.href='/consignments/{{$consignment->BOL}}'">
    <td>{{$consignment->BOL}}</td>
    <td>{{$consignment->value}}</td>
    <td>{{$consignment->tax}}</td>
    <td>{{$consignment->land_date}}</td>
    <td>{{$consignment->lc}}</td>
    <td>{{$consignment->created_at}}</td>
    <td>{{$consignment->updated_at}}</td>
    <!--<td><a href="/consignments/{{$consignment->BOL}}" >View Info</a></td>-->
  </tr>
  @endforeach
</tbody>


</table>
</div>
@endsection
