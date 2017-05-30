@extends('layout.mainlayout')


@section('content')

<span>NEW EXPENSE</span>

<form method="post" action="/consignment_expenses">

  {{ csrf_field() }}

  BOL# <input type="text" name="inputBOL"> <br>
  Expense Foreign <input type="text"  name="inputExpenseForeign"> <br>
  Expense Local<input type="text" name="inputExpenseLocal"> <br>
  Notes  <input type="text" name="inputNote"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
