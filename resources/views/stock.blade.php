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
      <table id ="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th> Tyre ID </th>
          <th> Brand </th>
          <th> Size </th>
          <th> Pattern </th>
          <th> LiSi </th>
          <td># in stock</td>
        </tr>
        </thead>
        <tbody>

        @foreach($in_stock as $item)
        <tr>
          <td class="text-center">{{$item->tyre_id}}</td>
          <td class="text-center">{{$item->brand}}</td>
          <td class="text-center">{{$item->size}}</td>
          <td class="text-center">{{$item->pattern}}</td>
          <td class="text-center">{{$item->lisi}}</td>
          <td class="text-center">{{$item->in_stock}}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection