@extends('layout.mainlayout')

@section('content')



<div class="container"> <!-- bootsreap container -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Expenses <small>All consignment expenses paid.</small></h1>
      </div>
    </div>
  </div>

<table class="table table-condensed">
<thead>
  <tr>
    <th>BOL#</th>
    <th>Expense id</th>
    <th>Expense Foreign Amount</th>
    <th>Expense Local Amount</th>
    <th>Notes</th>
    <th>Created</th>
    <th>Updated</th>
  </tr>
</thead>
<tbody>
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
</tbody>
</table>

</div>
@endsection
