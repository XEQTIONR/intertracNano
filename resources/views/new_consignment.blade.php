@extends('layout.mainlayout')

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

<form method="post" action="/consignments">

  {{ csrf_field() }}

  Bill of Lading# <input type="text" name="inputBOL"> <br>
  LC#<input type="text" name="inputLCnum" value="{{$lc_num}}"> <br>
  Value$ <input type="text" name="inputValue"> <br>
  Tax <input type="text" name="inputTax"> <br>
  Land Date <input type="text" class="pickdate" name="inputLandDate"> <br>

  <button type="submit" value="submit">Submit</button>

</form>

@endsection
