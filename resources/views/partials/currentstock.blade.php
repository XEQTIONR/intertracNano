<table class="table table-hover">
<thead>
  <tr>
    <th> Tyre ID </th>
    <th> Brand </th>
    <th> Size </th>
    <th> Pattern </th>

    <th> #remaining </th>

  </tr>
</thead>
<tbody>
  @foreach ($in_stock as $item)
    <tr>

      <td>{{$item->tyre_id}}</td>
      <td>{{$item->brand}}</td>
      <td>{{$item->size}}</td>
      <td>{{$item->pattern}}</td>

      <td>{{$item->in_stock}}</td>


    </tr>
  @endforeach
</tbody>
</table>
