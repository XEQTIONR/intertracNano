@extends('layout')

@section('content')

<form method="post" action="/lcs">

  {{ csrf_field() }}

  <input type="text" name="inputLCnum"> <br>
  <input type="text" name="inputDateIssue"> <br>
  <input type="text" name="inputDateExiry"> <br>
  <input type="text" name="inputApplicant"> <br>
  <input type="text" name="inputBeneficiary"> <br>
  <input type="text" name="inputPortDepart"> <br>
  <input type="text" name="inputPortArrive"> <br>
  <input type="text" name="inputInvoice"> <br>
  <input type="text" name="inputCurrencyCode"> <br>
  <input type="text" name="inputExchangeRate"> <br>
  <input type="text" name="inputValue"> <br>
  <input type="text" name="inputForeignExpense"> <br>
  <input type="text" name="inputLocalExpense"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
