<table class="table table-hover table-bordered">
<thead>
  <tr>
    <th> Tyre ID </th>
    <th> #remaining </th>
  </tr>
</thead>
<tbody>
  @foreach ($in_stock as $item)
    <tr>

      <td>{{$item->tyre_id}}</td>
      <td>{{$item->in_stock}}</td>

    </tr>
  @endforeach
</tbody>
</table>
