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
  <div class="box box-purple">
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

@section('footer-scripts')
  <script>


      function format ( rowData ) {
          console.log('rowData');
          console.log(rowData);
          var div = $('<div/>')
              .addClass( 'loading' )
              .text( 'Loading...' );
          $.ajax( {
              url: '/api/consignment_container',
              data: {
                  container : rowData[0],
                  consignment : rowData[1]
              },
              dataType: 'text',
              success: function ( view ) {
                  console.log('successed');
                  console.log(rowData);
                  div
                      .html( view )
                      .removeClass( 'loading' );

                  //div.addClass('zeload');

              },

              error : function(error){

                  div
                      .text('Error : Some kind of error occurred')
                      .removeClass( 'loading' );
                  console.log('error');
                  console.log(error);
              }
          } );

          return div;
      }

      $(document).ready(function() {

          $('#table_id tbody').on('click', 'tr', function () {
              var tr = $(this).closest('tr');
              var row = table.row( this );


              if ( row.child.isShown() ) {
                  row.child.hide();
                  tr.removeClass('shown');
              }
              else {

                  table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                      this
                          .child(
                              $('anything')
                          )
                          .hide();
                  } );

                  $('.shown').removeClass('shown');
                  row.child( format(row.data()) ).show();
                  tr.addClass('shown');

                  $('.shown + tr').css('background-color', '#f5f5f5');

              }
          } );
      } );




  </script>
@endsection
