@extends('layout.mainlayout')


@section('content')

<form method="post" action="/payments">

  {{ csrf_field() }}

  Order# <input type="text" name="inputOrderNum"> <br>
  Amount Paid <input type="text"  name="inputPaidAmount"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
