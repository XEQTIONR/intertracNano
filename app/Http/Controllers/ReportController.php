<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Payment;
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

      //some defaults
      $this->report_year = $date->year;
      $this->time_frame = 'year';

    }

    public function defaultOrderReport()
    {
      $orders = Order::ordersInYear($this->year);
      return $this->calculateOrderStats($orders);
    }

    public function defaultPaymentReport()
    {
      $payments = Payment::paymentsInYear($this->year);
      return $this->calculatePaymentStats($payments);
    }

    public function showPaymentReport($time_frame, $year)
    {
      $this->time_frame = $time_frame;
      $this->report_year = $year;
      if(is_numeric($time_frame)) //monthly report
      {
        $payments = Payment::paymentsInMonth($time_frame, $this->year);
        return $this->calculatePaymentStats($payments);

      }

      else if($time_frame=="year")   //yearly report;
      {
        $payments = Payment::paymentsInYear($year);
        return $this->calculatePaymentStats($payments);
      }

      else  //quarterly report
      {
        $pieces = explode("Q", $time_frame);

        if(is_numeric($pieces[1]))
        {
          $payments = Payment::paymentsInQuarter($pieces[1], $year);
          return $this->calculatePaymentStats($payments);
          //return $orders;

        }
      }

    }

    public function showOrderReport($time_frame, $year)
    {
      $this->time_frame = $time_frame;
      $this->report_year = $year;
      if(is_numeric($time_frame)) //monthly report
      {
        $orders = Order::ordersInMonth($time_frame, $this->year);
        return $this->calculateOrderStats($orders);

      }

      else if($time_frame=="year")   //yearly report;
      {
        $orders = Order::ordersInYear($year);
        return $this->calculateOrderStats($orders);
      }

      else  //quarterly report
      {
        $pieces = explode("Q", $time_frame);

        if(is_numeric($pieces[1]))
        {
          $orders = Order::ordersInQuarter($pieces[1], $year);
          return $this->calculateOrderStats($orders);
          //return $orders;

        }
      }

    }

    public function showOutstandingBalanceReport()
    {
      $orders = Order::all();


      return $this->calculateOutstandingBalanceStats($orders);
    }

    public function calculateOutstandingBalanceStats($orders)
    {

      $customers = collect();
      $num_orders=0;
      $total_owed=0;
      $total_value=0;

      foreach ($orders as $item)
      {
        $order = Order::find($item->Order_num);
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
    }

    public function calculatePaymentStats($payments)
    {
      $total_value = 0;
      $avg_payment = 0;
      $orders = collect();
      foreach ($payments as $item)
      {
          $payment = Payment::find($item->Invoice_num);
          $total_value+= $payment->payment_amount;
          $orders->push($payment->Order_num);
      }

      $year = $this->year;
      $report_year = $this->report_year;
      $time_frame = $this->time_frame;

      $unique = $orders->unique();
      $num_payments = count($payments);
      $num_orders = count($unique);

      if($num_payments>0)
        $avg_payment = $total_value/floatval($num_payments);
      // or use the default value of zero

      $date = Carbon::now('America/Toronto');

      $total_value = number_format($total_value,2);
      $avg_payment = number_format($avg_payment,2);

      return view('reports.payment', compact('unique',
                                            'num_payments',
                                            'num_orders',
                                            'total_value',
                                            'avg_payment',
                                            'year',
                                            'report_year',
                                            'time_frame',
                                            'date',
                                            'payments'));
    /*  return compact('unique',
                                            'num_payments',
                                            'num_orders',
                                            'total_value',
                                            'avg_payment',
                                            'year',
                                            'report_year',
                                            'time_frame');*/
      //return [count($payments), count($unique), $total_value, $total_value/floatval(count($payments))];
    }

    public function calculateOrderStats($orders)
    {

      $total_value = 0;
      $orders_full_paid = 0;
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

        if ($order->payable==0) {
          $orders_full_paid++;
        }
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
      $date = Carbon::now('America/Toronto');//
      if($count_tyres>0)
        $avg_value = $total_value/$count_tyres; //5. Avg value of orders.
      else $avg_value=0;
      if($count>0)
        $avg_tyre = $count_tyres/$count; //4. Avg number of tyres per order
      else $avg_tyre=0;

      $year = $this->year;
      $report_year = $this->report_year;
      $time_frame = $this->time_frame;

      $total_value = number_format($total_value,2);
      $avg_value = number_format($avg_value,2);
      $avg_tyre = number_format($avg_tyre,2);

      return view('reports.order', compact('date',
                                  'time_frame',
                                  'year',
                                  'report_year',
                                  'count',
                                  'count_tyres',
                                  'total_value',
                                  'avg_value',
                                  'avg_tyre',
                                  'orders_with_payments',
                                  'orders_full_paid',
                                  'orders'));
    }

    public function orderReport()
    {

    }

}
