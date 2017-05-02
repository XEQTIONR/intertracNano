@extends('layout')

@section('content')

<table>
  <tr>
    <th>tyre_id</th>
    <th>tyre_brand</th>
    <th>tyre_size</th>
    <th>tyre_pattern</th>
  </tr>



  <?php
  foreach ($tyres as $tyre)
  {
    echo "<tr>";
    echo "<td>";
    echo $tyre->id;
    echo "</td>";
    echo "<td>";
    echo $tyre->tyre_size;
    echo "</td>";
    echo "</tr>";
  }
  ?>


</table>

@endsection
