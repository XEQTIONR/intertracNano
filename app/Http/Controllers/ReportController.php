<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Order_content;

class ReportController extends Controller
{
    //
    protected $month, $year;

    public function __construct()
    {
      $this->middleware('auth');
      $date = Carbon::now('America/Toronto');
      $this->month = $date->month;
      $this->year = $date->year;

    }

    public function showOrderReport()
    {
      $orders = Order::ordersInMonth($this->month, $this->year);
      return $this->stats($orders);
    }

    public function stats($orders)
    {

      $total_value = 0;
      foreach($orders as $item)
      {

        //INITILIZE some calculated values

        //cannot directly use $item->orderContents()
        $order = Order::find($item->Order_num);
        $order->totalValueBeforeDiscountAndTax();
        $order->calculateAndSetDiscount();
        $order->calculateAndSetTax();
        $order->calculatePayable();
        $total_value += $order->subtotal+$order->totalTax-$order->totalDiscount;// 3. Total value of orders
      }

      $count = count($orders); //1. No of orders
      $count_tyres = 0;

      $orders_with_payments = 0;
      foreach ($orders as $item)
      {
          //cannot directly use $item->orderContents()
          $order = Order::find($item->Order_num);
          $payments = $order->payment()
                          ->get();
          $orders_with_payments+= (count($payments)>0); //6.num orders with payments
          $contents = $order->orderContents()
                            ->get();
          foreach ($contents as $content)
          {
            $count_tyres += $content->qty; //2. No of tyres sold
          }
      }
      $date = Carbon::now('America/Toronto');
      $avg_value = $total_value/$count_tyres; //5. Avg value of orders.
      $avg_tyre = $count_tyres/$count; //4. Avg number of tyres per order
      return view('home', compact('date','time_frame','count','count_tyres','total_value','avg_value','orders_with_payments'));
    }

    public function orderReport()
    {

    }

}
