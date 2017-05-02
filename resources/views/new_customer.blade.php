@extends('layout')

@section('content')

<form method="post" action="/customers">

  {{ csrf_field() }}

  Customer/Party Name <input type="text" name="inputName"> <br>
  Address <input type="text" name="inputAddress"> <br>
  Phone# <input type="text" name="inputPhone"> <br>
  Notes <input type="text" name="inputNotes"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
