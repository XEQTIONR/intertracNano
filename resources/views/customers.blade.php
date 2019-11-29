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
              <div class="btn-group" > <!-- style="display: block; min-width: 80px" -->
                <button type="button" data-toggle="tooltip" title="Edit" onclick="startEdit({{$customer->id}})" class="btn bg-orange-active" style="border-color : #FFF"><i class="fa  fa-edit"></i></button>
{{--                <button type="button" class="btn bg-orange-active" style="border-color : #FFF"><i class="icon-clipboard-list-r"></i></button>--}}
              </div>
            </td>
          </tr>
        @endforeach
        <tbody>
      </table>
    </div>
  </div>

  <div class="modal modal-warning fade in" id="modalForm">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title"> <i class="icon-users-s  mr-2" style="position: relative; top: 3px"></i> Edit Customer</h4>
        </div>
        <div class="modal-body">
          <div class="spinner-container" style="margin-top: 9vh; margin-bottom: 10vh;">
          <i style="margin-left: 48%; font-size: 2rem" class="fa fa-spinner fa-spin"></i><br>
            <p class="text-center">Loading</p>
          </div>
          <div class="success-container">
            <i class="fa fa-check mr-3 text-success"></i> Customer successfully updated.
          </div>
          <form role="form" class="form">

            <input type="hidden" id="customer_id" class="form-control" placeholder="Enter ...">

            <!-- text input -->
            <div class="form-group">
              <label>Name</label>
              <input type="text" id="name" class="form-control" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea id="address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" id="phone" class="form-control" placeholder="Enter ...">
            </div>

            <!-- textarea -->

            <div class="form-group">
              <label>Notes</label>
              <textarea id="notes" class="form-control" rows="3" placeholder="Enter ..."></textarea>
            </div>

            <a onclick="finishEdit()" class="btn btn-flat btn-block btn-success">Update Customer</a>

          </form>
        </div>
      </div>
      <!-- /.modal-content -->
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

      function startEdit(customer_id){
          console.log("EDIT CUSTOMER CALLED :"+customer_id);

          //$('#modalForm').show();
          $('#modalForm').modal();
          $('.spinner-container').show();
          $('.form').hide();
          $.ajax({
              url: '{{route('customers.apiShow')}}',
              method: "POST",
              data : {
                  _token : "{{csrf_token()}}",
                  customer : customer_id
              },
              dataType : 'json',
              success : function(data){
                  console.log("success editCustomer");
                  console.log(data);
                  //$('#modalForm').show();

                  $('#customer_id').val(data.id);
                  $('#name').val(data.name);
                  $('#address').val(data.address);
                  $('#phone').val(data.phone);
                  $('#notes').val(data.notes);
                  $('.spinner-container').hide();
                  $('.form').show();

              },
              // error: function(xhr, status, error) {
              //     var err = eval("(" + xhr.responseText + ")");
              error : function(error){
                  console.log("ERROR editCustomer");
                  console.log(error);
              }

          });



      }

      function finishEdit(){
          console.log("FINISH EDIT CALLED");

          var data = {
              _token : "{{csrf_token()}}",
              customer :  $('#customer_id').val(),
              name : $('#name').val(),
              address :  $('#address').val(),
              phone :  $('#phone').val(),
              notes :  $('#notes').val()
          };
          console.log(data);

          $.ajax({
              url: '{{route('customers.apiUpdate')}}',
              method: "POST",
              data : data,
              success : function(data){
                  console.log("SUCCESS EDITING");
                console.log(data);
                $(".form").hide();
                $(".success-container").show();

                setTimeout(function(){
                    window.location.href = '{{route('customers.index')}}';
                }, 3000);
              },
              error : function(error){
                  console.log("Error saving");
              }
          });
      }

      $(document).ready(function() {

          $('.success-container').hide();
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
              e.stopPropagation(); // (A) .so that event doesn't spill over to tr
          });

          $("#table_id").on('draw.dt', function(){
              $('#table_id tbody .btn-group').on('click', 'button', function (e) {
                  e.stopPropagation(); // Do (A) Again on table redraw
              });
          })

          //$('#modalForm').modal();
          //$('#modalForm').hide();
          //$('#name').val('Some val');
      } );




  </script>

@endsection
