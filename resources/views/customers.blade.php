@extends('layouts.app')

@section('title')
  Customers
@endsection
@section('subtitle')
  All our customers, past and present.
@endsection

@section('level')
  @component('components.level',
    ['crumb' => 'Customers',
    'subcrumb' => 'All customers',
    'link' => route('customers.index')])
  @endcomponent
@endsection

@section('body')
  <div class="box box-orange">
    <div class="box-body">
      <table id ="table_id" class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
          <th>Customer ID</th>
          <th>Customer Name</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Notes</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
          <tr>
            <td class="text-center">{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->address}}</td>
            <td class="">{{$customer->phone}}</td>
            <td>{{$customer->notes}}</td>
            <td class="text-center">{{$customer->created_at}}</td>

            {{--<td class="text-center">{{$customer->updated_at}}</td>--}}
            {{--<td><a href="/customers/{{$customer->id}}" class="btn btn-primary">More Info</a></td>--}}
            <td class="text-center">
              <div class="btn-group" style="display: block; min-width: 80px">
                <button type="button" class="btn bg-orange-active" style="border-color : #FFF"><i class="fa  fa-edit"></i></button>
                <button type="button" class="btn bg-orange-active" style="border-color : #FFF"><i class="icon-clipboard-list-r"></i></button>
              </div>
            </td>
          </tr>
        @endforeach
        <tbody>
      </table>
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
              url: '/customers/'+rowData[0],
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

          $('#table_id tbody').on('click', 'tr', function (e) {

                  var tr = $(this).closest('tr');
                  var row = table.row(this);

                  console.log(row);

                  if (row.child.isShown()) {
                      row.child.hide();
                      tr.removeClass('shown');
                  } else {

                      table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                          this
                              .child(
                                  $('anything')
                              )
                              .hide();
                      });

                      $('.shown').removeClass('shown');
                      row.child(format(row.data())).show();
                      tr.addClass('shown');

                      $('.shown + tr').css('background-color', '#f5f5f5');

                  }
          } );

          $('#table_id tbody .btn-group').on('click', 'button', function (e) {
              e.stopPropagation(); // so that event doesn't spill over to tr
          });
      } );




  </script>

@endsection
