<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
