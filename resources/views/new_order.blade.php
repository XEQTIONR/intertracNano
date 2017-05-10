@extends('layout')


@section('content')

<form method="post" action="/orders">

  {{ csrf_field() }}

  Customer ID <input type="text" name="inputCustomerId"> <br>
  Discount % <input type="text"  name="inputDiscountPercent"> <br>
  Discount Amount <input type="text" name="inputDiscountAmount"> <br>
  Tax % <input type="text" name="inputTaxPercent"> <br>
  Tax Amount <input type="text" name="inputTaxAmount"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
