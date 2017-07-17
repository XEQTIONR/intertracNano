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
      $count = count($orders);
      $count_tyres = 0;
      $total_value = 0;
      $orders_with_payments = 0;
      foreach ($orders as $item)
      {
          //cannot directly use $item->orderContents()
          $order = Order::find($item->Order_num);
          $payments = $order->payment()
                          ->get();
          $orders_with_payments+= count($payments);
          $contents = $order->orderContents()
                            ->get();
          foreach ($contents as $content) {
            $count_tyres += $content->qty;
            $total_value+= ($content->qty * $content->unit_price);
          }
      }
      $date = Carbon::now('America/Toronto');
      $avg_value = $total_value/$count_tyres;
      return view('home', compact('date','time_frame','count','count_tyres','total_value','avg_value','orders_with_payments'));
    }

    public function orderReport()
    {

    }

}
