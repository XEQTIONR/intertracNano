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
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        //{
        $order  = new Order;

        $order->customer_id = $request->inputCustomerId;
        $order->discount_percent = $request->inputDiscountPercent;
        $order->discount_amount = $request->inputDiscountAmount;
        $order->tax_percentage = $request->inputTaxPercent;
        $order->tax_amount = $request->inputTaxAmount;

        $order->save();

        for ($i=0; $i<$request->numItems; $i++)
        {

          $contents[$i] = new Order_content;


          $contents[$i]->Order_num = $order->Order_num;
          $contents[$i]->tyre_id = $request->tyre[$i];
          $contents[$i]->unit_price = $request->price[$i];
          $contents[$i]->qty = $request->qty[$i];
        }

        $order->orderContents()->saveMany($contents);
        //});
        DB::commit();


        //echo $order->Order_num;  // last insert id
        return redirect('/orders');
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
