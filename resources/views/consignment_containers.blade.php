@extends('layouts.app')

@section('title')
  Containers
@endsection
@section('subtitle')
  All containers arrived in country.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Containers',
    'subcrumb' => 'All Containers',
    'link'  =>  route('consignment_containers.index')])
  @endcomponent
@endsection



@section('body')
  <div class="box">
    <div class="box-body">
      <table id="table_id" class="table table-hover table-bordered">
        <thead>
        <tr>
          <th>Container#</th>
          <th>BOL#</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Progress</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($containers as $container)
          <tr>
            <td>{{$container->Container_num}}</td>
            <td>{{$container->BOL}}</td>
            <td>{{$container->created_at}}</td>
            <td>{{$container->updated_at}}</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
