@extends('layout')

@section('scripts')

<script>
$( function()
  {
    $( ".pickdate" ).datepicker();

    $(".pickdate").datepicker("option", "dateFormat", "yy-mm-dd");
  });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('content')

<form method="post" action="/lcs">

  {{ csrf_field() }}

  LC# <input type="text" name="inputLCnum"> <br>
  Date Issued <input type="text" class="pickdate" name="inputDateIssue"> <br>
  Date Expiry <input type="text" class="pickdate" name="inputDateExpiry"> <br>
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
