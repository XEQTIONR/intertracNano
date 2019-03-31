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
  <div class="box">
    <div class="box-body">
      <table id="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th>BOL#</th>
          <th>LC#</th>
          <th>$ Rate</th>
          <th>Value($)</th>
          <th>Value(&#2547)</th>
          <th>Tax(&#2547)</th>
          <th>Land Date</th>
          <th>Created</th>
          {{--<th>Updated</th>--}}
          <th>Progress</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($consignments as $consignment)
          <tr style="cursor: pointer;" onclick="location.href='/consignments/{{$consignment->BOL}}'">
            <td class="text-center">{{$consignment->BOL}}</td>
            <td class="text-center">{{$consignment->lc}}</td>
            <td class="text-right">{{$consignment->exchange_rate}}</td>
            <td class="text-right">{{$consignment->value}}</td>
            <td class="text-right">{{$consignment->value * $consignment->exchange_rate}}</td>
            <td class="text-right">{{$consignment->tax}}</td>
            <td class="text-center">{{$consignment->land_date}}</td>
            <td class="text-center">{{$consignment->created_at}}</td>
            {{--<td class="text-center">{{$consignment->updated_at}}</td>--}}
            <td>
              <div class="progress progress-xs">
                {{--<div class="progress-bar progress-bar-danger" style="width: 80%"></div>--}}
              </div>
            </td>

          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>


@endsection