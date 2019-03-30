@extends('layouts.app')

@section('title')
  Tyre Catalog
@endsection
@section('subtitle')
  All kinds of tyres imported.
  @endsection

  @section('level')
    @component('components.level',
      ['crumb' => 'Tyres',
      'subcrumb' => 'All tyres',
      'link' => route('tyres.index')])
    @endcomponent
  @endsection

@section('body')
  <div class="box">
    <div class="box-body">
      @include('partials.tyres')
    </div>
  </div>


@endsection
