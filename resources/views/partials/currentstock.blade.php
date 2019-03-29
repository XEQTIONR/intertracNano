<table id ="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th> Tyre ID </th>
    <th> Brand </th>
    <th> Size </th>
    <th> Pattern </th>

    <th> # remaining </th>

  </tr>
</thead>
<tbody>
  @foreach ($in_stock as $item)
    <tr>

      <td class="text-center">{{$item->tyre_id}}</td>
      <td class="text-center">{{$item->brand}}</td>
      <td class="text-center">{{$item->size}}</td>
      <td class="text-center">{{$item->pattern}}</td>

      <td class="text-center">{{$item->in_stock}}</td>


    </tr>
  @endforeach
</tbody>
</table>
