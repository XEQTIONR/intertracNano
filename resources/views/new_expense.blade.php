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

      <form class="form-horizontal" method="post" action="/consignment_expenses">
        {{ csrf_field() }}
        @include('partials.errors')

        <div class="form-group">
          <label for="inputBOL" class="col-md-3 col-md-offset-2 control-label">BOL#</label>
          <div class="col-md-3">
          @if ($bol=="")
            <input type="text" class="form-control" name="inputBOL" value="{{old('inputBOL')}}">
          @else
            <input type="text" class="form-control" name="inputBOL" value="{{$bol}}" readonly>
          @endif
          </div>
        </div>

        <div class="form-group">
          <label for="inputExpenseForeign" class="col-md-3 col-md-offset-2 control-label">Expense Foreign#</label>
          <div class="col-md-3">
            <input type="text"  class="form-control" name="inputExpenseForeign" value="{{old('inputExpenseForeign')}}">
          </div>
        </div>

        <div class="form-group">
          <label for="inputExpenseLocal" class="col-md-3 col-md-offset-2 control-label">Expense Local</label>
          <div class="col-md-3">
            <input type="text" class="form-control" name="inputExpenseLocal" value="{{old('inputExpenseLocal')}}">
          </div>
        </div>

        <div class="form-group">
          <label for="inputNote" class="col-md-3 col-md-offset-2 control-label">Notes</label>
          <div class="col-md-3">
        <!--Notes  <input type="text" name="inputNote"> <br>-->
            <textarea rows="5" class="form-control" name="inputNote" id="inputNotes" >{{old('inputNote')}}</textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-md-1 col-md-offset-5">
            <button type="submit" value="submit">Submit</button>
          </div>
        </div>


      </form>
    </div>
  </div>
</div>

@endsection
