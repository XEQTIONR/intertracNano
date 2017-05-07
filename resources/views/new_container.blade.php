@extends('layout')


@section('content')

<form method="post" action="/consignment_containers">

  {{ csrf_field() }}

  Container# <input type="text" name="inputContainerNum"> <br>
  BOL# <input type="text"  name="inputBOL"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
