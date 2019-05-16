<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_return;
use \DB;
use Carbon\Carbon;

class ReturnController extends Controller
{

    public function returns(Request $request)
    {

      $order = Order::find($request->input('order'));
      $contents = $order->orderContents()->get();
      $returns = $request->input('returns');

      $tax = floatval($request->input('tax'));
      $discount = floatval($request->input('discount'));

      if($tax!=$order->tax_amount || $discount!=$order->discount_amount)
      {
        if($tax>0)
          $order->tax_amount = $tax;
        if($discount>0)
          $order->discount_amount = $discount;

        $order->save();
      }


      foreach($returns as $return)
      {
        $qty_remain = intval($return['qty']);

        foreach($contents as $content)
        {
          if($content->tyre_id == $return['tyre_id']
            && $content->bol == $return['bol']
            && $content->container_num == $return['container_num']
            && floatval($content->unit_price) == floatval($return['unit_price'])
            && $content->qty>0)
          {
            if($content->qty >= $qty_remain)
            {
              $content->qty -= $qty_remain;
              $qty_remain = 0;
            }
            else
            {
              $qty_remain -= $content->qty;
              $content->qty = 0;
            }
          }

          if($qty_remain == 0)
            break;
        }
      }

      $collection = array();

      foreach($returns as $return)
      {
        $obj = new Order_return;

        $obj->order_num = $return['Order_num'];
        $obj->tyre_id = $return['tyre_id'];
        $obj->container_num = $return['container_num'];
        $obj->bol =  $return['bol'];
        $obj->qty = $return['qty'];
        $obj->unit_price = $return['unit_price'];

        $collection[] = $obj;
      }

      foreach($contents as $content)
      {
        DB::table('order_contents')
          ->where('Order_num', $content->Order_num)
          ->where('tyre_id', $content->tyre_id)
          ->where('container_num', $content->container_num)
          ->where('bol', $content->bol)
          ->where('unit_price', $content->unit_price)
          ->update(['qty' => $content->qty, 'updated_at' => Carbon::now()]);
      }

//      $order->orderContents()->saveMany($contents);
      $order->orderReturns()->saveMany($collection);


      return array('status' => 'success');
      //return compact('order', 'contents', 'returns', 'collection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      $orders = Order::with(['customer','payments', 'orderContents.tyre'])->get();

      foreach($orders as $order)
      {
        $order->customer->address =  str_replace("\n", "", nl2br($order->customer->address));
      }
      return view('new_return', compact('orders'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
