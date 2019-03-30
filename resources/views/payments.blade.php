@extends('layouts.app')

@section('title')
  Payments
@endsection
@section('subtitle')
  All recorded payments made by customers.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Payments',
    'subcrumb' => 'All payments',
    'link'  =>  route('payments.index')])
  @endcomponent
@endsection



@section('body')
  <div class="box">
    <div class="box-body">
      @include('partials.tables.payments')
    </div>
  </div>


@endsection
