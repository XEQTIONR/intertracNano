<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private static $contents;


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
        $in_stock = Order::tyresRemaining();
        return view('new_order',compact('in_stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function setContent($index, $order, $tyre, $price, $container, $bol)
    {
      OrderController::contents[$index] = new Order_content;

      //Set the information from request
      OrderController::contents[$index]->Order_num = $order->Order_num;
      OrderController::contents[$index]->tyre_id = $request->tyre[$i];
      OrderController::contents[$index]->unit_price = $request->price[$i];

      //Set the information from the stock listing generated
      OrderController::contents[$index]->Container_num = $stock_listing->Container_num;
      OrderController::contents[$index]->BOL = $stock_listing->BOL;



    }
    public function store(Request $request)
    {
        //
        //return Order::tyreInContRemaining(2);

        //return $stock;
        DB::beginTransaction();
        //{
        $order  = new Order;

        $order->customer_id = $request->inputCustomerId;
        $order->discount_percent = $request->inputDiscountPercent;
        $order->discount_amount = $request->inputDiscountAmount;
        $order->tax_percentage = $request->inputTaxPercent;
        $order->tax_amount = $request->inputTaxAmount;

        $order->save();


        $index = 0;
        unset($GLOBALS['contents']);


        for ($i=0; $i<$request->numItems; $i++) // each tyre
        {

          $full_qty = $request->qty[$i]; //total number of tyre[i] ordered
          $qty_remain = $full_qty; //remaining qty to be filled

          $in_stock = Order::tyreInContRemaining($request->tyre[$i]); // stock info for tyre_id i


          foreach ($in_stock as $stock_listing) // each stock entry
          {
            //Create a new order_content entry

            $this->contents[$index] = new Order_content;

            //Set the information from request
            $this->contents[$index]->Order_num = $order->Order_num;
            $this->contents[$index]->tyre_id = $request->tyre[$i];
            $this->contents[$index]->unit_price = $request->price[$i];

            //Set the information from the stock listing generated
            $this->contents[$index]->Container_num = $stock_listing->Container_num;
            $this->contents[$index]->BOL = $stock_listing->BOL;


            if ($qty_remain <= $stock_listing->in_stock) //one entry covers the entire qty
            {

              $this->contents[$index]->qty = $qty_remain;
              break; // stop looping

            }
            else // more entries needed keep looping
            {

              $this->contents[$index]->qty = $stock_listing->in_stock; // take all the tyres in this entry for this order
              $qty_remain -= $stock_listing->in_stock; // adjust further number of tyres to be filled
              $index++; // index of next entry
            }

          }

        }
        return $this->contents;
        //$order->orderContents()->saveMany($this->contents);
        //});
        //DB::commit();


        //echo $order->Order_num;  // last insert id
        //return redirect('/orders');

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
