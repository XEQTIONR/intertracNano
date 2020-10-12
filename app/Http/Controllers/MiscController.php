<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use DB;

class MiscController extends Controller
{
    //

    public function welcome()
    {
      $highest_owing_customers = collect(DB::select(resolve('CustomersOwingSQL'). 'LIMIT 5'));

      $all_orders = collect(DB::select(resolve('OrdersSummarySQL')));

      $all_orders->each(function($order) {

          $discount = (floatval($order->total) * floatval($order->discount_percent)/100.0) + floatval($order->discount_amount);
          $tax = (floatval($order->total) * floatval($order->tax_percentage)/100.0) + floatval($order->tax_amount);

          $order->discount_total = $discount;
          $order->tax_total = $tax;

          $order->grand_total = floatval($order->total) - floatval($discount) + floatval($tax);

          $order->balance = $order->grand_total - $order->payments_total;
      });

      $highest_no_payments =  $all_orders
        ->filter(function($item) { return floatval($item->payments_total) == 0; })
        ->sortByDesc(function($item) { return floatval($item->total);})
        ->values()
        ->take(5);

      $newest_owing_orders = $all_orders
        ->filter(function($item) { return (floatval($item->grand_total) - floatval($item->payments_total)) > 0; })
        ->sortByDesc('created_at')
        ->values()
        ->take(5);

//      return $newest_owing_orders;


      return view('welcome',
        ['now' => \Carbon\Carbon::now(),
          'highest_owing_customers' => $highest_owing_customers,
          'highest_no_payments' => $highest_no_payments,
          'newest_owing_orders' => $newest_owing_orders]);
    }
}
