<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Order extends Model
{
    //
    public $primaryKey = 'Order_num';


    public function orderContents()
    {
      return $this->hasMany('App\Order_content', 'Order_num');
    }
    public function payment()
    {
      return $this->hasMany('App\Payment','Order_num');
    }

    public function customer()
    {
      return $this->belongsTo('App\Customer','customer_id');
    }

    public function calculateAndSetDiscount()
    {
      $discount_percent = ($this->subtotal * ($this->discount_percent/100.0));
      $this->totalDiscount = $discount_percent + $this->discount_amount;
    }

    public function calculateAndSetTax()
    {
      $tax_percent_amt = ($this->subtotal * ($this->tax_percentage/100.0));
      $this->totalTax = $tax_percent_amt + $this->tax_amount;

    }

    public function calculatePayable()
    {
        $total = ($this->subtotal+$this->totalTax-$this->totalDiscount);
        $payments = $this->payment()
                        ->get();
        foreach ($payments as $payment)
        {
          $total -= $payment->payment_amount;
        }

        $this->payable = $total;
    }

    /* Total value before tax and discount */
    public function totalValueBeforeDiscountAndTax()
    {
        $total_value=0;
        $contents = $this->orderContents()
                        ->get();
        foreach ($contents as $content)
        {

          $total_value+= ($content->qty * $content->unit_price);
        }

        $this->subtotal = $total_value;
    }



//HELPER FUNCTIONS
    public static function tyreInContRemaining($id)
    {
      $remaining = DB::table('container_contents')
                  ->select('Container_num', 'BOL','tyre_id','qty')
                  ->leftJoin(DB::raw('(SELECT container_num, bol, tyre_id, SUM(qty) AS sumqty
                                      FROM order_contents
                                      GROUP BY container_num, bol, tyre_id) AS B'),

                            function($join)
                            {
                              $join->on('container_contents.tyre_id','=','B.tyre_id')
                                ->on('container_contents.BOL','=','B.bol')
                                ->on('container_contents.Container_num','=','B.container_num');

                            })
                  ->select('container_contents.Container_num',
                            'container_contents.BOL',
                            'container_contents.tyre_id',
                            'container_contents.qty AS qty_bought',
                            DB::raw('IFNULL(B.sumqty,0) AS qty_sold'),
                            DB::raw('(container_contents.qty - IFNULL(B.sumqty,0)) AS in_stock')
                            )
                  ->where('container_contents.tyre_id', $id)
                  ->oldest()
                  ->get();

                  //dd($remaining->toSql());

        return $remaining;
    }

    public static function tyresRemaining()
    {
      //tyres_remaining.sql
      $remaining = DB::table('container_contents')
                  ->select('Container_num', 'BOL','tyre_id','qty')
                  ->leftJoin(DB::raw('(SELECT container_num, bol, tyre_id, SUM(qty) AS sumqty
                                      FROM order_contents
                                      GROUP BY container_num, bol, tyre_id) AS B'),

                            function($join)
                            {
                              $join->on('container_contents.tyre_id','=','B.tyre_id')
                                ->on('container_contents.BOL','=','B.bol')
                                ->on('container_contents.Container_num','=','B.container_num');

                            })
                  ->select('container_contents.Container_num',
                            'container_contents.BOL',
                            'container_contents.tyre_id',
                            'container_contents.qty AS qty_bought',
                            DB::raw('IFNULL(B.sumqty,0) AS qty_sold'),
                            DB::raw('(container_contents.qty - IFNULL(B.sumqty,0)) AS in_stock')
                            )
                  ->join('tyres', 'container_contents.tyre_id','=','tyres.tyre_id')
                  ->select('container_contents.tyre_id', 'tyres.brand', 'tyres.size', 'tyres.pattern', DB::raw('SUM(container_contents.qty - IFNULL(B.sumqty,0)) AS in_stock'))
                  ->groupBy('container_contents.tyre_id')




                  ->get();

                  //dd($remaining->toSql());

        return $remaining;


    }

    public static function ordersInMonth($month, $year)
    {
      $orders = DB::table('orders')
                ->whereMonth('created_at', '=', $month)
                ->whereYear('created_at', '=', $year)
                ->get();
      return $orders;
    }

    public static function ordersInQuarter($quarter, $year)
    {
      $startmonth="";
      $endmonth="";
      switch ($quarter) {
        case 1:
          $startmonth="January";
          $endmonth="March";
        break;

        case 2:
          $startmonth="April";
          $endmonth="June";
        break;

        case 3:
          $startmonth="July";
          $endmonth="September";
        break;

        case 4:
        $startmonth="October";
        $endmonth="December";
        break;
      }

      $start_date = new Carbon("First day of ". $startmonth. " ".$year);
      $end_date = new Carbon ("Last day of ". $endmonth. " ".$year);
      $end_date = $end_date->addHours(23);
      $end_date = $end_date->addMinutes(59);
      $end_date = $end_date->addHours(59);
    /*
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '>', 3*$quarter-1);

      $orders = $orders->whereMonth('created_at', '<=', 3*$quarter)
                ->get();*/

      $orders = DB::table('orders')
              ->whereBetween('created_at',[$start_date, $end_date])
              ->get();
      return $orders;
    }


    public static function ordersInYear($year)
    {
      $orders = DB::table('orders')
                ->whereYear('created_at', '=', $year)
                ->get();
      return $orders;
    }
}
