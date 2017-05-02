@extends('layout')

@section('content')

<form method="post" action="/tyres">

  {{ csrf_field() }}

  Brand <input type="text" name="inputBrand"> <br>
  Size Code<input type="text" name="inputSize"> <br>
  Pattern Code <input type="text" name="inputPattern"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
