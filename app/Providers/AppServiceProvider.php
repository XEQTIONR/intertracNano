<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->bind('TyresRemainingInContainers', function(){
          $remaining = DB::select('
      
                  SELECT C.* , IFNULL((qty_bought - qty_sold), qty_bought) AS in_stock FROM
                  (SELECT Container_num, BOL, tyre_id, SUM(qty) as qty_bought, MIN(created_at) as created_at 
		              FROM container_contents
		              GROUP BY Container_num, BOL, tyre_id) AS C

		              LEFT JOIN

		              (SELECT container_num, bol, tyre_id, SUM(qty) AS qty_sold
		              FROM order_contents
		              GROUP BY container_num, bol, tyre_id) AS B
	
		              ON (C.tyre_id = B.tyre_id AND C.BOL = B.bol AND C.Container_num = B.container_num)
		              ORDER BY created_at ASC
	    
      
          ');

          return collect($remaining); //because we need collection not array
        });

        app()->bind('TyresRemaining', function(){

          $remaining = DB::select('
      
          SELECT T.tyre_id, T.brand, T.size, T.pattern, T.lisi, E.qtyavailable AS in_stock
          FROM	(SELECT  C.tyre_id, SUM(C.supplyqty -  IFNULL(B.sumqty,0)) AS qtyavailable  
                FROM  (SELECT Container_num, BOL, tyre_id, SUM(qty) as supplyqty 
                      FROM container_contents
                      GROUP BY Container_num, BOL, tyre_id) AS C
    
                      LEFT JOIN
    
                      (SELECT container_num, bol, tyre_id, SUM(qty) AS sumqty
                      FROM order_contents
                      GROUP BY container_num, bol, tyre_id) AS B
      
                      ON (C.tyre_id = B.tyre_id AND C.BOL = B.bol AND C.Container_num = B.container_num)
                GROUP BY tyre_id) E, tyres T	
          WHERE T.tyre_id = E.tyre_id
        
        ');




        //         ->get();

        //dd($remaining->toSql());

        return $remaining;

      });
    }
}
