<table id="table_id" class="table table-striped">
<thead>
  <tr>
    <th>Tyre ID</th>
    <th>Brand</th>
    <th>Size</th>
    <th>Li/Si</th>
    <th>Pattern</th>
    <th>created_at</th>
  </tr>
</thead>
<tbody>
  @foreach ($tyres as $tyre)
    <tr>
      <td class="strong">{{$tyre->tyre_id}}</td>
      <td>{{$tyre->brand}}</td>
      <td>{{$tyre->size}}</td>
      <td>{{$tyre->lisi}}</td>
      <td>{{$tyre->pattern}}</td>
      <td>{{$tyre->created_at}}</td>
    </tr>
  @endforeach
</tbody>
</table>

@if(isset($tyres->links))
  {{$tyres->links()}}
@endif
