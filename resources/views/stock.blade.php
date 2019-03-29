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
        @include('partials.currentstock')
@endsection
