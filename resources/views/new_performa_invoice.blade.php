@extends('layout.mainlayout')


@section('scripts')
  <style>
    .leftDiv{
      width : 50%;
      float : left;
      margin : auto;
    }
    .rightDiv{
      width : 50%;
      float : right;
      margin : auto;
    }

  </style>
  <script src="/js/addItem.js"></script>
@endsection

@section('content')

<span>ENTER PERFORMA INVOICE ITEMS FOR LC</span><br><br>

<div class="leftDiv">
<form method="post" action="/performa_invoices">

  {{ csrf_field() }}

  LC#<input type="text" name="inputLC"> <br>

  <button type="button" onclick="addItem()">Add New Item</button>
  <button type="submit" value="submit">Submit</button>
  <button type="button" onclick="removeItem()">Remove Last Item</button>

  <div id="itemList" style="border: 2px dashed black;">

  </div> <br>

  Num items <input type="text"  name="numItems" id="numItems" readonly>

</form>
</div>

<div class="rightDiv">
  <table class="DBinfo">
    <tr>
      <th>tyre_id</th>
      <th>Tyre Brand</th>
      <th>Tyre Size</th>
      <th>Tyre Pattern</th>
      <th>Created</th>
      <th>Updated</th>
    </tr>


    @foreach ($tyres as $tyre)
      <tr>
      <td>{{$tyre->tyre_id}}</td>
      <td>{{$tyre->brand}}</td>
      <td>{{$tyre->size}}</td>
      <td>{{$tyre->pattern}}</td>
      <td>{{$tyre->created_at}}</td>
      <td>{{$tyre->updated_at}}</td>
    </tr>
    @endforeach



  </table>
</div>


@endsection
