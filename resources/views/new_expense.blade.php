@extends('layout.mainlayout')


@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>New Expense <small>Add a new consignment expense.</small></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <form method="post" action="/consignment_expenses">
        {{ csrf_field() }}
        BOL# <input type="text" name="inputBOL"> <br>
        Expense Foreign <input type="text"  name="inputExpenseForeign"> <br>
        Expense Local<input type="text" name="inputExpenseLocal"> <br>
        Notes  <input type="text" name="inputNote"> <br>

        <button type="submit" value="submit">Submit</button>
      </form>
    </div>
  </div>
</div>

@endsection
