@extends('layout.mainlayout')

@section('content')


<span>CONSIGNMENT EXPENSES</span>

<table class="DBinfo">
  <tr>
    <th>BOL#</th>
    <th>Expense id</th>
    <th>Expense Foreign Amount</th>
    <th>Expense Local Amount</th>
    <th>Notes</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>


  @foreach ($expenses as $expense)
  <tr>
    <td>{{$expense->BOL}}</td>
    <td>{{$expense->expense_id}}</td>
    <td>{{$expense->expense_foreign}}</td>
    <td>{{$expense->expense_local}}</td>
    <td>{{$expense->expense_notes}}</td>
    <td>{{$expense->created_at}}</td>
    <td>{{$expense->updated_at}}</td>
  </tr>
  @endforeach



</table>

@endsection
