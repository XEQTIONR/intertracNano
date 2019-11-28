@extends('layouts.app')

@section('title')
  Orders
@endsection
@section('subtitle')
  All orders placed.
@endsection

@section('level')
  @component('components.level',['crumb' => 'Orders', 'subcrumb' => 'All orders'])
  @endcomponent
@endsection



@section('body')
  <div class="box box-info">
    <div class="box-body">
      @include('partials.tables.orders')
    </div>
  </div>

@endsection

@section('footer-scripts')
<script>


  function format ( rowData ) {
      var div = $('<div/>')
          .addClass( 'loading' )
          .html( '<i style="margin-left: 50%; font-size: 2rem" class="fa fa-spinner fa-spin"></i>' );

      $.ajax( {
          url: '/api/order',
          data: {
              order : rowData[0]
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

      table.order([0, 'desc'])
           .draw();

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
