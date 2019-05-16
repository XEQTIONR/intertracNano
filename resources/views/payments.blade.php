@extends('layouts.app')

@section('title')
  Payments
@endsection
@section('subtitle')
  All recorded payments made by customers.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Payments',
    'subcrumb' => 'All payments',
    'link'  =>  route('payments.index')])
  @endcomponent
@endsection



@section('body')
  <div class="box">
    <div class="box-body">
      @include('partials.tables.payments')
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
              url: '/api/order',
              data: {
                  order : rowData[1]
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