<table id="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    <th>Tyre ID</th>
    <th>Brand</th>
    <th>Size</th>
    <th>Li/Si</th>
    <th>Pattern</th>
  </tr>
</thead>
<tbody>
  @foreach ($tyres as $tyre)
    <tr>
      <td>{{$tyre->tyre_id}}</td>
      <td>{{$tyre->brand}}</td>
      <td>{{$tyre->size}}</td>
      <td>{{$tyre->lisi}}</td>
      <td>{{$tyre->pattern}}</td>
    </tr>
  @endforeach
</tbody>
</table>

@if(isset($tyres->links))
  {{$tyres->links()}}
@endif
