<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        return view('payments', compact('payments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $orders = Order::with(['customer:id,name,address,phone','payments', 'orderContents.tyre'])->get();

      foreach($orders as $order)
      {
        $order->customer->address =  str_replace("\n", "", nl2br($order->customer->address));
        //$order->customer->notes =  str_replace("\n", "", nl2br($order->customer->notes));
      }


      return view('new_payment', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //VALIDATE
        $amount = $request->amount;
        $order = Order::find(intval($request->order));
        $payable = floatval($order->calculatePayable());
        $duplicate = Payment::where('random', $request->random)->first();

        if($amount > $payable)
        {
          $response = [];

          $response['status'] = 'failed';
          $response['message'] = "Amount paid is greater than payable amount.";

          return $response;
        }

        if($duplicate!= null){

          $response = [];
          
          $response['status'] = 'failed';
          $response['message'] = "Duplicate Request. Your payment may have been already added.".
                                  " Check and then try again if required.";

          return $response;
        }

        //ALLOCATE
        $payment = new Payment;

        //INITIALIZE
        $payment->Order_num = $request->order;
        $payment->payment_amount = $request->amount;
        $payment->random = $request->random;
        //STORE
        $payment->save();
        $payment->new = true;

        //REDIRECT
        $response = [];

        $response['status'] = 'success';
        $response['payment'] = $payment;

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
