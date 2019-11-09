<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Order_content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      //Not using auth in super class because of other middleware used
      $this->middleware('auth');

      $this->middleware('no_payments')->only('edit');
    }

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
        $orders = DB::select('
          SELECT T.*, IFNULL(P.payments_total,0) AS payments_total 
          FROM  (SELECT O.*, D.total 
                FROM (SELECT B.*, SUM(B.multiply) as total 
                      FROM (SELECT C.*, C.unit_price*C.qty AS multiply 
                            FROM order_contents C) AS B 
                GROUP BY B.Order_num) D, orders O 
          WHERE D.Order_num = O.Order_num) T
          
          LEFT JOIN
          
          (SELECT Order_num, SUM(payment_amount) as payments_total FROM payments GROUP BY Order_num) AS P
          
          ON T.Order_num = P.Order_num

        ');

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

    public function edit(Order $order)
    {
      //$customers = Customer::all(); //remove
      $in_stock = Order::tyresRemaining();
      $customer =  $order->customer;

      //****** remove
      //foreach($customers as $customer)
      //{

        $customer->address = str_replace("\n", "",nl2br($customer->address));
      //}

      $i = 0;
      foreach($in_stock as $stock)
      {
        $stock->qty = 0;
        $stock->unit_price = 0;
        $stock->i = $i;
        $i++;
      }
      // **************


      // adjusting stock to contain items of current order (so we can reuse subtraction code)
      $order_contents = Order_content::where('Order_num', $order->Order_num)->with('tyre')->get();//$order->orderContents->with('tyre');

      foreach($order_contents as $content)
      {
        $tyre_id = $content->tyre_id;

        foreach($in_stock as $stock)
        {
          if($stock->tyre_id == $tyre_id)
          {
            $stock->in_stock = intval($stock->in_stock) + $content->qty;
            $content->i = $stock->i;
            break;
          }
        }
      }
       //dd(json_encode($order_contents));
      return view('edit_order', compact('order', 'order_contents' , 'in_stock', 'customer'));
      //echo $order->Order_num;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      return $this->storeHelper($request);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function detailsRow(Request $request)
    {
      $id = $request->input('order');
      $order =  \App\Order::with(['customer', 'orderContents.tyre', 'orderReturns.tyre', 'payments'])->find($id);

      $subtotal = 0;
      $subtotalReturn = 0;
      $qtytotal = 0;
      $qtytotalReturn = 0;

      foreach($order->orderContents as $item)
      {
        $subtotal += (floatval($item->qty)*floatval($item->unit_price));
        $qtytotal += intval($item->qty);
      }



      $order->subtotal = $subtotal;

      $order->taxtotal = ($subtotal * $order->tax_percentage/100.0) + $order->tax_amount;
      $order->discounttotal = ($subtotal * $order->discount_percent/100.0) + $order->discount_amount;

      $order->grandtotal = $order->subtotal + $order->taxtotal - $order->discounttotal;

      $grandtotal = $order->grandtotal;

      foreach($order->payments as $payment)
      {
        $grandtotal -= $payment->payment_amount;
        $payment->balance = $grandtotal;
      }

      foreach($order->orderReturns as $item)
      {
        $subtotalReturn += (floatval($item->qty)*floatval($item->unit_price));
        $qtytotalReturn += intval($item->qty);
      }


      $order->subtotalReturn = $subtotalReturn;

      $order->taxtotalReturn = ($subtotalReturn * $order->tax_percentage/100.0) + $order->tax_amount;
      $order->discounttotalReturn = ($subtotalReturn * $order->discount_percent/100.0);

      $order->grandtotalReturn = $order->subtotalReturn + $order->taxtotalReturn - $order->discounttotalReturn;

      $order->qtytotal = $qtytotal;
      $order->qtytotalReturn = $qtytotalReturn;

      return view('partials.rows.order', compact('order'));
    }

    public function show(Order $order)
    {
        //
        $customer = Customer::find($order->customer_id);

//        $contents = $order->orderContents()
//                        ->get();
//
//        $payments = $order->payments()->get();

        //INITILIZE some calculated values
        $order->totalValueBeforeDiscountAndTax();
        $order->calculateAndSetDiscount();
        $order->calculateAndSetTax();
        $order->calculatePayable();

        return view('profiles.order', compact('order','customer'));
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
      return $this->storeHelper($request, $order);
      //return [$request->input('order_contents'), $order];
    }


    private function storeHelper(Request $request, Order $order = null)
    {

      //VALIDATE

      $duplicate = Order::where('random', $request->random)->first();


      if($duplicate!=null)
      {
        $response = [];

        $response['status'] = 'failed';
        $response['message'] = "Duplicate Request. Your order may have been already added.".
                                  " Check and then try again if required.";

        return $response;
      }
      Log::debug('in Store Helper');
      DB::beginTransaction();
      try {

        if(is_null($order))
          $order = new Order;
        else
          $order->orderContents()->delete();
        // javascript null becomes 0. ($request->input('past'))
        if($request->has('past') && ($request->input('past') != "0"))
          $order->order_on=Carbon::createFromFormat('d/m/Y', $request->input('past_date'))->toDateString();

        else if($request->has('edit')) {
        }
        else
          $order->order_on=Carbon::now()->toDateString();

        $order->customer_id=$request->input('customer');
        $order->discount_percent=$request->input('discount_percent');
        $order->discount_amount=$request->input('discount_amount');
        $order->tax_percentage=$request->input('tax_percent');
        $order->tax_amount=$request->input('tax_amount');
        $order->random = $request->input('random');

        Log::debug('before order->save');
        $order->save();
        Log::debug('after order->save');

        $order_contents=$request->input('order_contents');

        $tyre_remaining_cont=Order::tyresRemainingInContainers();

        $new_contents=array();

        foreach ($order_contents as $order_content) {
          $tyre=$order_content[ 'tyre_id' ];
          $qty=intval($order_content[ 'qty' ]);
          $unit_price=floatval($order_content[ 'unit_price' ]);

          $filtered=$tyre_remaining_cont->where('tyre_id', $tyre)
            ->filter(function ($value, $key) {

              $keys[]=$key;
              return (intval($value->in_stock)>0);
            })
            ->all();

          foreach ($filtered as $key=>$item) {
            $order_content=new Order_content;

            $order_content->tyre_id=$tyre;
            $order_content->Container_num=$item->Container_num;
            $order_content->BOL=$item->BOL;
            $order_content->unit_price=$unit_price;

            if (intval($item->in_stock)>=$qty) {
              $order_content->qty=$qty;
              $tyre_remaining_cont[ $key ]->in_stock=intval($tyre_remaining_cont[ $key ]->in_stock)-$qty;

              array_push($new_contents, $order_content);
              break; // loop exit
            } else {
              $qty-=intval($item->in_stock);
              $order_content->qty=intval($item->in_stock);
              $tyre_remaining_cont[ $key ]->in_stock=0;

              array_push($new_contents, $order_content);
            }


            //            $new_contents [] = $order_content;
          }


        }


        $new_contents=collect($new_contents)->filter(function ($value) {
          return intval($value->qty)>0;
        })
          ->all();

        $order->orderContents()->saveMany($new_contents);
        DB::commit();
        //
        $response=[];

        $response[ 'status' ]='success';
        $response[ 'order_num' ]=$order->Order_num;
        $response[ 'date' ]=$order->order_on;
        return $response;
      }
      catch(\Exception $e)
      {
        DB::rollback();

        $response[ 'status' ] = 'failed';
        $response['past'] = $request->input('past');
        return $response;
      }
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

    public function viewReceipt(Order $order){

      return view('components.receipt', compact('order'));
    }
}
