@extends('layout.mainlayout')

@section('content')

<div class="container"> <!-- bootsreap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Customer List  <small>All our customers.</small></h1>
      </div>
    </div>
  </div>

<table class="table table-hover table-condensed">
<thead>
  <tr>
    <th>customer#</th>
    <th>Customer Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Notes</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>
<tbody>
  @foreach ($customers as $customer)
  <tr style="cursor: pointer" onclick="location.href='/customers/{{$customer->id}}'">
    <td class="text-center">{{$customer->id}}</td>
    <td>{{$customer->name}}</td>
    <td>{{$customer->address}}</td>
    <td class="text-center">{{$customer->phone}}</td>
    <td>{{$customer->notes}}</td>
    <td class="text-center">{{$customer->created_at}}</td>
    <td class="text-center">{{$customer->updated_at}}</td>
    {{--<td><a href="/customers/{{$customer->id}}" class="btn btn-primary">More Info</a></td>--}}
  </tr>
  @endforeach
<tbody>
</table>
</div>

@endsection
