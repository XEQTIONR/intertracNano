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
  return view('layout');
});


Route::resource('tyres','TyreController');

Route::resource('lcs','LcController');

Route::resource('consignments','ConsignmentController');

Route::resource('customers','CustomerController');

Route::resource('consignment_expenses','ConsignmentExpenseController');

Route::resource('consignment_containers','ConsignmentContainerController');

Route::resource('performa_invoices','PerformaInvoiceController');

Route::resource('orders','OrderController');

Route::resource('payments','PaymentController');

Route::resource('hscodes','HscodeController');

Route::resource('container_contents', 'ContainerContentController');

Route::resource('order_contents', 'OrderContentController');








Route::get('title', function()
{
  return view('title');
});

//Route::get('/', 'WelcomeController@show');
