@extends('layouts.app')


@section('body')

  <h2>Welcome to <b>nanoDB</b></h2>
  <p>Stock and accounting tool for Intertrac Nano</p>
  <span>Current version : <b>{{ config('app.version') }}</b></span>
@endsection