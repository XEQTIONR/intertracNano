@extends('layout')

@section('content')

<form method="post" action="/lcs">

  {{ csrf_field() }}

  LC# <input type="text" name="inputLCnum"> <br>
  Date Issued <input type="text" name="inputDateIssue"> <br>
  Date Expiry <input type="text" name="inputDateExiry"> <br>
  Applicant <input type="text" name="inputApplicant"> <br>
  Beneficiary <input type="text" name="inputBeneficiary"> <br>
  Departing Port<input type="text" name="inputPortDepart"> <br>
  Arrival Port<input type="text" name="inputPortArrive"> <br>
  Invoice# <input type="text" name="inputInvoice"> <br>
  Foreign Currency Code <input type="text" name="inputCurrencyCode"> <br>
  Exchange Rate <input type="text" name="inputExchangeRate"> <br>
  LC Value (Foreign Amount)<input type="text" name="inputValue"> <br>
  Expenses Paid (Foreign)<input type="text" name="inputForeignExpense"> <br>
  Expenses Paid (Local)<input type="text" name="inputLocalExpense"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
