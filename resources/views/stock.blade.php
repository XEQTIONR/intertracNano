@extends('layouts.app')

@section('title')
  Current Stock
@endsection
@section('subtitle')
  Our current inventory, items we can sell.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Stock',
    'subcrumb' => 'Current inventory',
    'link' => route('stock')])
  @endcomponent
@endsection

@section('body')
  <div class="box" id="app">
    <div class="box-body">
      <table id ="table_id" class="table table-striped">
        <thead>
        <tr>
          <th class=" col-xs-1"> Tyre ID </th>
          <th class=" col-xs-3"> Brand </th>
          <th class=" col-xs-2"> Size </th>
          <th class=" col-xs-2"> Pattern </th>
          <th class=" col-xs-2"> LiSi </th>
          <th class=" col-xs-2"># in stock</th>
        </tr>
        </thead>
        <tbody>

        @foreach($in_stock as $item)
        @if($item->in_stock > 0)
        <tr>
          <td class="text-center col-xs-1 strong">{{$item->tyre_id}}</td>
          <td class="text-center col-xs-3">{{$item->brand}}</td>
          <td class="text-center col-xs-2">{{$item->size}}</td>
          <td class="text-center col-xs-2">{{$item->pattern}}</td>
          <td class="text-center col-xs-2">{{$item->lisi}}</td>
          <td class="text-center col-xs-2 strong">{{$item->in_stock}}</td>
        </tr>
        @endif
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection