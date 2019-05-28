<table class="table table-bordered">
  <thead>
  <tr>
    <th colspan="6">Container# {{$container->Container_num}}</th>
  </tr>
  <tr>
    <th class="col-xs-3">Tyre</th>
    <th class="col-xs-1">Qty</th>
    <th class="col-xs-2">Unit Price</th>
    <th class="col-xs-2">Sub-total</th>
    <th class="col-xs-2">Total Tax</th>
    <th class="col-xs-2">Total Weight</th>
  </tr>

  </thead>
  <tbody>
  <?php $total= 0; $total_qty = 0; $total_tax = 0; $total_weight = 0; ?>
  @foreach ($container->contents as $listing) {{--each container--}}
  {{--@ means if not empty--}}
  {{--@if (@$content_one_container[0]->Container_num==$container->Container_num) --}}{{-- if this container add BOL later --}}

  {{--@foreach($content_one_container as $listing) --}}{{---each tyre qty price etc--}}
  <tr>
    <td class="col-xs-3">{{$listing->tyre->brand}} {{$listing->tyre->size}} {{$listing->tyre->pattern}} {{$listing->tyre->lisi}}</td>
    <td class="col-xs-1">{{$listing->qty}}</td>
    <td class="col-xs-2">{{number_format($listing->unit_price,2)}}</td>
    <td class="col-xs-2">{{number_format($listing->qty * $listing->unit_price,2)}}</td>
    <td class="col-xs-2">{{number_format($listing->total_tax,2)}}</td>
    <td class="col-xs-2">{{number_format($listing->total_weight,2)}}</td>
  </tr>
  <?php
  $total+= (floatval($listing->unit_price) * floatval($listing->qty));
  $total_qty += intval($listing->qty);
  $total_tax += floatval($listing->total_tax);
  $total_weight += floatval($listing->total_weight);
  ?>
  {{--@endforeach--}}

  {{--@endif--}}
  @endforeach
  <tr class="strong">
    <td class="col-xs-3 text-uppercase"> TOTAL </td>
    <td class="col-xs-1"> {{$total_qty}} </td>
    <td class="col-xs-2"> </td>
    <td class="col-xs-2"> {{number_format($total, 2)}} </td>
    <td class="col-xs-2"> {{number_format($total_tax, 2)}} </td>
    <td class="col-xs-2"> {{number_format($total_weight, 2)}} </td>
  </tr>
  </tbody>
</table>