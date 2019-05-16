@extends('layouts.app')

@section('title')
  Customers
@endsection
@section('subtitle')
  All our customers, past and present.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Customers',
    'subcrumb' => 'All customers',
    'link' => route('customers.index')])
  @endcomponent
@endsection

@section('body')
  <div class="box box-orange">
    <div class="box-body">
      <table id ="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th>Customer #</th>
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
  </div>
@endsection
