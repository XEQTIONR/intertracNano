<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Order_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public static function setContents(&$contents, $index, $order_num, $tyre_id, $price, $stock_listing, $qty_remain)
    {
      $item = new Order_content;

      //Set the information from request
      $item->Order_num = $order_num;
      $item->tyre_id = $tyre_id;
      $item->unit_price = $price;

      //Set the information from the stock listing generated
      $item->Container_num = $stock_listing->Container_num;
      $item->BOL = $stock_listing->BOL;


      if ($qty_remain <= $stock_listing->in_stock) //one entry covers the entire qty
      {

        $item->qty = $qty_remain;
        $qty_remain = 0;
      }
      else // more entries needed keep looping
      {
        $item->qty = $stock_listing->in_stock; // take all the tyres in this entry for this order
        $qty_remain -= $stock_listing->in_stock; // adjust further number of tyres to be filled
      }

      array_push($contents, $item);

      return $qty_remain;

    }
    public function index()
    {
        //
        $orders = Order::all();

        //return $in_stock;
        //dd(DB::getQueryLog());
        return view('orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer::all();
        $in_stock = Order::tyresRemaining();

        foreach($customers as $customer)
        {

          $customer->address = str_replace("\n", "",nl2br($customer->address));
        }

        $i = 0;
        foreach($in_stock as $stock)
        {
          $stock->qty = 0;
          $stock->unit_price = 0;
          $stock->i = $i;
          $i++;
        }

        return view('new_order',compact('in_stock', 'customers'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        DB::beginTransaction();

        $order  = new Order;

        $order->customer_id = $request->input('customer');
        $order->discount_percent = $request->input('discount_percent');
        $order->discount_amount = $request->input('discount_amount');
        $order->tax_percentage = $request->input('tax_percent');
        $order->tax_amount = $request->input('tax_amount');

        $order->save();


        $order_contents = $request->input('order_contents');

        $tyre_remaining_cont = Order::tyresRemainingInContainers();

        $new_contents = array();

        foreach($order_contents as $order_content)
        {
          $tyre = $order_content['tyre_id'];
          $qty = intval($order_content['qty']);
          $unit_price = floatval($order_content['unit_price']);

          $filtered = $tyre_remaining_cont->where('tyre_id', $tyre)
                                          ->filter(function($value, $key){

                                              $keys[] = $key;
                                              return (intval($value->in_stock)>0);
                                          })
                                          ->all();

          foreach($filtered as $key => $item)
          {
            $order_content =  new Order_content;

            $order_content->tyre_id = $tyre;
            $order_content->Container_num = $item->Container_num;
            $order_content->BOL = $item->BOL;
            $order_content->unit_price = $unit_price;

            if(intval($item->in_stock)>=$qty)
            {
              $order_content->qty = $qty;
              $tyre_remaining_cont[$key]->in_stock = intval($tyre_remaining_cont[$key]->in_stock) - $qty;

              array_push($new_contents, $order_content);
              break; // loop exit
            }
            else
            {
              $qty -= intval($item->in_stock);
              $order_content->qty = intval($item->in_stock);
              $tyre_remaining_cont[$key]->in_stock = 0;

              array_push($new_contents, $order_content);
            }


//            $new_contents [] = $order_content;
          }



        }


        $new_contents = collect($new_contents)->filter(function($value){
          return intval($value->qty) > 0;
        })
        ->all();

        $order->orderContents()->saveMany($new_contents);
        DB::commit();
//
        $response = [];

        $response['status'] = 'success';
        $response['order_num'] = $order->Order_num;
        $response['date'] = $order->created_at;
        return $response;


        //      }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        $customer = Customer::find($order->customer_id);

        $contents = $order->orderContents()
                        ->get();

        $payments = $order->payment()
                          ->get();

        //INITILIZE some calculated values
        $order->totalValueBeforeDiscountAndTax();
        $order->calculateAndSetDiscount();
        $order->calculateAndSetTax();
        $order->calculatePayable();

        return view('profiles.order', compact('order','contents','customer','payments'));
    }

    public function showJSON($order_num)
    {
      //
     //  $customer = Customer::find($order->customer_id);
      $order = Order::find($order_num);

      return compact('order');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
