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
      
                  SELECT C.* , IFNULL((qty_bought - qty_sold - IFNULL(waste, 0)), qty_bought) AS in_stock
                  FROM
                    (SELECT Container_num, BOL, tyre_id, SUM(qty) as qty_bought, MIN(created_at) as created_at 
                    FROM container_contents
                    GROUP BY Container_num, BOL, tyre_id) AS C
  
                    LEFT JOIN
  
                    (SELECT container_num, bol, tyre_id, SUM(qty) AS qty_sold
                    FROM order_contents
                    GROUP BY container_num, bol, tyre_id) AS B
	                  
	                  ON (C.tyre_id = B.tyre_id AND C.BOL = B.bol AND C.Container_num = B.container_num)
	                  
	                  LEFT JOIN 
	                  
	                  (SELECT Container_num, BOL, tyre_id, SUM(qty) as waste
	                  FROM waste
	                  GROUP BY Container_num, BOL, tyre_id) AS W
	                  
	                  ON (C.tyre_id = W.tyre_id AND C.BOL = W.BOL AND C.Container_num = W.Container_num)
		              
		              ORDER BY created_at ASC
	    
      
          ');

          return collect($remaining); //because we need collection not array
        });

        app()->bind('TyresRemaining', function(){

          $remaining = DB::select('
      
          SELECT T.tyre_id, T.brand, T.size, T.pattern, T.lisi, E.qtyavailable AS in_stock
          FROM	(SELECT  C.tyre_id, SUM(C.supplyqty -  IFNULL(B.sumqty,0) - IFNULL(W.waste,0)) AS qtyavailable  
                FROM  (SELECT Container_num, BOL, tyre_id, SUM(qty) as supplyqty 
                      FROM container_contents
                      GROUP BY Container_num, BOL, tyre_id) AS C
    
                      LEFT JOIN
    
                      (SELECT container_num, bol, tyre_id, SUM(qty) AS sumqty
                      FROM order_contents
                      GROUP BY container_num, bol, tyre_id) AS B
                      
                      ON (C.tyre_id = B.tyre_id AND C.BOL = B.bol AND C.Container_num = B.container_num)                      
                      
                      LEFT JOIN 
	                  
                      (SELECT Container_num, BOL, tyre_id, SUM(qty) as waste
                      FROM waste
                      GROUP BY Container_num, BOL, tyre_id) AS W
                      
                      ON (C.tyre_id = W.tyre_id AND C.BOL = W.BOL AND C.Container_num = W.Container_num)
      

                GROUP BY tyre_id) E, tyres T	
          WHERE T.tyre_id = E.tyre_id
        
        ');

        return collect($remaining);

      });

        app()->bind('CustomersOwingSQL', function(){

          $customers = '
            
            SELECT C.*, B.*, (B.sum_grand_total - B.sum_payments_total) AS balance_total
            FROM customers C LEFT JOIN
            (SELECT customer_id, SUM(sub_total) AS sum_sub_total, 
                    SUM(grand_total) AS sum_grand_total, 
                    SUM(payments_total) AS sum_payments_total,
                    COUNT(*) AS number_of_orders
            FROM
                (SELECT orders.customer_id, ST.sub_total, 
                        (ST.sub_total - ((ST.sub_total*orders.discount_percent)/100) - orders.discount_amount + ((ST.sub_total*orders.tax_percentage)/100) + orders.tax_amount) AS grand_total,
                        IFNULL(payment_total, 0) AS payments_total
                FROM orders
                    INNER JOIN  (SELECT Order_num, SUM(qty*unit_price) as sub_total
                                FROM order_contents
                                GROUP BY Order_num) as ST
                        
                    ON orders.Order_num = ST.Order_num
                            
                    LEFT JOIN (SELECT Order_num, SUM(payment_amount-refund_amount) as payment_total
                               FROM payments
                               GROUP BY Order_num) as P
                    ON orders.Order_num = P.Order_num) AS A
            GROUP BY customer_id) B
            
            ON C.id = B.customer_id
            
            ORDER BY balance_total DESC
          
          ';

          return $customers;
        });

        app()->bind('OrdersSummary', function(){
            $orders = collect(DB::select(
              'SELECT T.*, IFNULL(P.payments_total,0) AS payments_total, IFNULL(P.count,0) AS num_payments 
                FROM  (SELECT O.*, D.sub_total, C.name 
                        FROM (SELECT B.Order_num, SUM(B.multiply) as sub_total 
                                FROM (SELECT C.Order_num, C.unit_price*C.qty AS multiply 
                                        FROM order_contents C) AS B 
                                GROUP BY B.Order_num) D, orders O, customers C 
                                WHERE D.Order_num = O.Order_num 
                                AND O.customer_id = C.id) T
          
                LEFT JOIN
                (SELECT Order_num, (SUM(payment_amount) - SUM(refund_amount)) as payments_total, COUNT(*) AS count 
                  FROM payments 
                  GROUP BY Order_num) AS P
          
                  ON T.Order_num = P.Order_num'
            ));

            $orders->each(function($order) {

                $discount = (floatval($order->sub_total) * floatval($order->discount_percent)/100.0) + floatval($order->discount_amount);
                $tax = (floatval($order->sub_total) * floatval($order->tax_percentage)/100.0) + floatval($order->tax_amount);

                $order->discount_total = $discount;
                $order->tax_total = $tax;

                $order->grand_total = floatval($order->sub_total) - floatval($discount) + floatval($tax);

                $order->balance = $order->grand_total - $order->payments_total;
            });

            return $orders;
        });

        app()->singleton('CurrencyFormatter', function(){
            $fmt = numfmt_create( 'en_IN', \NumberFormatter::DECIMAL );
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 2);
            $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);
            //$fmt->setSymbol(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL, "’");
            return $fmt;
        });



    }
}
