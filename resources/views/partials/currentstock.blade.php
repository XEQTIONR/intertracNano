<table class="DBinfo">
  <tr>
    <th> Tyre ID </th>
    <th> #remaining </th>
  </tr>
  @foreach ($in_stock as $item)
    <tr>

      <td>{{$item->tyre_id}}</td>
      <td>{{$item->in_stock}}</td>

    </tr>
  @endforeach

</table>
