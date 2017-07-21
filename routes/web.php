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
  return view('welcome');
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
  return view('stock', compact('in_stock'));
});



Route::get('reports/order/', 'ReportController@defaultOrderReport');

Route::get('reports/order/{time_frame}/{year}', 'ReportController@showOrderReport');


Route::get('reports/payment/', 'ReportController@defaultPaymentReport');

Route::get('reports/payment/{time_frame}/{year}', 'ReportController@showPaymentReport');

Route::get('reports/expense', 'ReportController@showExpenseReport');

Route::get('reports/outstanding_balance', 'ReportController@showOutstandingBalanceReport');

Route::get('reports/profit', 'ReportController@showProfitReport');



Route::get('test', function()
{
  $orders = App\Order::all();
  $customers = collect();
  //$num_customers=0;
  $num_orders=0;
  $total_owed=0;
  $total_value=0;

  foreach ($orders as $order)
  {
    $order->totalValueBeforeDiscountAndTax();
    $order->calculateAndSetDiscount();
    $order->calculateAndSetTax();
    $order->calculatePayable();
    $order->final_value = $order->subtotal + $order->totalTax - $order->totalDiscount;

    if ($order->payable>0)
    {

      $customers->push($order->customer_id);
      $num_orders++;
      $total_owed+= $order->payable;
      $total_value+= $order->final_value;
    }
    //$customer = $order->customer()->get();
    //$order->customer_id = $order->customer()->id;
  }

  $unique = $customers->unique();
  $num_customers = count($unique);
  return [$orders, $customers, $unique, $total_owed, $total_value, $num_orders, $num_customers];
});




Route::get('title', function()
{
  return view('title');
});

//Route::get('/', 'WelcomeController@show');

Auth::routes();

Route::get('/home', 'HomeController@index');
