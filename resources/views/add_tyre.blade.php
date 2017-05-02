@extends('layout')

@section('content')

<form method="post" action="/tyres">

  {{ csrf_field() }}

  <input type="text" name="inputBrand"> <br>
  <input type="text" name="inputSize"> <br>
  <input type="text" name="inputPattern"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
