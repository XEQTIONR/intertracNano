@extends('layout')

@section('content')

<form method="post" action="/tyres">

  {{ csrf_field() }}

  <input type="text" name="inputBrand">
  <input type="text" name="inputSize">
  <input type="text" name="inputPattern">

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
