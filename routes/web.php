<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', 'WelcomeController@show');

//Route::get('test', 'WelcomeController@show');

Route::get('/', function()
{
  return view('layout.mainlayout');
});


Route::resource('tyres','TyreController');

Route::resource('lcs','LcController');


//To pass the lc_num
Route::get('/consignments/create/{lc}', 'ConsignmentController@createGivenLC');

Route::resource('consignments','ConsignmentController');



Route::resource('customers','CustomerController');

Route::resource('consignment_expenses','ConsignmentExpenseController');

Route::resource('consignment_containers','ConsignmentContainerController');

Route::resource('performa_invoices','PerformaInvoiceController');


//raw json order info
Route::get('/orders/json/{order_num}', 'OrderController@showJSON');

Route::resource('orders','OrderController');



Route::resource('payments','PaymentController');

Route::resource('hscodes','HscodeController');



Route::get('/container_contents/create/{bol}', 'ContainerContentController@createGivenBOL');

Route::resource('container_contents', 'ContainerContentController');



Route::resource('order_contents', 'OrderContentController');


Route::get('stock', function()
{
  $in_stock = App\Order::tyresRemaining();
  return view('partials.currentstock', compact('in_stock'));
});

Route::get('layout2', function()
{
  return view('layout.layout2');
});




Route::get('title', function()
{
  return view('title');
});

//Route::get('/', 'WelcomeController@show');
