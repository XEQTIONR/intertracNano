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

@section('header-scripts')
  <style>
  .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background-color: #00c0ef !important;
    border-color: #00c0ef !important;
  }
  </style>
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
          .html( '<i style="margin-left: 50%; font-size: 2rem" class="fa fa-spinner fa-pulse"></i>' );

      $.ajax( {
          url: '/orders/'+rowData[0],
          // data: {
          //     order : rowData[0]
          // },
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


      table = $('#table_id').DataTable({
          destroy : true,

          footerCallback : function(row, data, start, end, display){
              //console.log("FOOTER CALLBACK");
              //console.log(row);
              var api = this.api(), data;

              var page = $('.dataTables_filter input').val().length>0 ? 'current' : 'all';


              var total = api
                  .column( 4, {page: page} )
                  .data()
                  .reduce( function (a, b) {
                      return parseFloat(a) + parseFloat(b.replace(/,/g, ''));
                  }, 0 );

              var payments_total = api
                  .column( 5, {page: page} )
                  .data()
                  .reduce( function (a, b) {
                      return parseFloat(a) + parseFloat(b.replace(/,/g, ''));
                  }, 0 );


              var balance_total = api
                  .column( 6, {page: page} )
                  .data()
                  .reduce( function (a, b) {
                      return parseFloat(a) + parseFloat(b.replace(/,/g, ''));
                  }, 0 );

              var footer_label = (page == 'current') ? 'TOTAL (current page)' : 'TOTAL (all pages)';



              $( api.column( 0 ).footer() ).html(footer_label);
              $( api.column( 4 ).footer() ).html("৳  "+commafy(total));
              $( api.column( 5 ).footer() ).html("৳  "+commafy(payments_total));
              $( api.column( 6 ).footer() ).html("৳  "+commafy(balance_total));
          }
      });






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
