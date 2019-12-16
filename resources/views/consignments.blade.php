@extends('layouts.app')

@section('title')
  Consignments
@endsection
@section('subtitle')
  All Consignemnts arrived.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Consignments',
    'subcrumb' => 'All Consignments',
    'link'  =>  route('consignments.index')])
  @endcomponent
@endsection



@section('body')
  <div class="box box-teal">
    <div class="box-body">
      <table id="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th>BOL#</th>
          <th>LC#</th>
          <th>Rate</th>
          <th>Value($)</th>
          <th>Value(&#2547)</th>
          <th>Tax(&#2547)</th>
          <th>Land Date</th>
          <th>Created</th>
          {{--<th>Updated</th>--}}
          <th>Stock</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($consignments as $consignment)
          <tr style="cursor: pointer;" onclick="location.href='/consignments/{{$consignment->BOL}}'">
            <td class="text-center strong">{{$consignment->BOL}}</td>
            <td class="">{{$consignment->lc}}</td>
            <td class="text-right">{{number_format($consignment->exchange_rate,2)}}</td>
            <td class="text-right">{{number_format($consignment->value, 2)}}</td>
            <td class="text-right">{{number_format($consignment->value * $consignment->exchange_rate,2)}}</td>
            <td class="text-right">{{$consignment->tax}}</td>
            <td class="text-center">{{$consignment->land_date}}</td>
            <td class="text-center">{{$consignment->created_at}}</td>
            {{--<td class="text-center">{{$consignment->updated_at}}</td>--}}
            <td>

              @if($consignment->percentage == 0)
                <small class="label bg-gray" data-toggle="tooltip" title="All {{$consignment->total_sold}} sold">empty</small>
              @elseif($consignment->percentage == 100)
                <small class="label bg-primary" data-toggle="tooltip" title="{{$consignment->total_bought}} total">full</small>
              @else
                <div class="progress progress-xs" data-toggle="tooltip" title="{{$consignment->total_bought - $consignment->total_sold}}/{{$consignment->total_bought}} remaining">
                  <div class="progress-bar progress-bar-<?php if($consignment->percentage<33) echo "danger"; else {  echo $consignment->percentage<66 ?  "warning" :  "success"; } ?>"
                       style="width: {{$consignment->percentage}}%"></div>
                </div>
              @endif
            </td>

          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>


@endsection

@section('footer-scripts')
<script>
  $(document).ready(function() {

      table.order([7, 'desc'])
          .draw();
  });

</script>
@endsection