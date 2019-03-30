@extends('layouts.app')

@section('title')
  Orders
@endsection
@section('subtitle')
  All orders placed.
@endsection

@section('level')
  @component('components.level',['crumb' => 'Orders', 'subcrumb' => 'All orders'])
  @endcomponent
@endsection



@section('body')
  <div class="box">
    <div class="box-body">
      @include('partials.tables.orders')
    </div>
  </div>

@endsection
